<?php

namespace App\Classes\Sockets;

use App\Classes\Sockets\Base\BaseSocket;
use App\Models\Auth\Profile;
use App\Models\Message\Chat;
use App\Models\Message\ChatRequest;
use Ratchet\ConnectionInterface;
use SplObjectStorage;

class ChatSocket extends BaseSocket
{

    private const REQUEST_LOAD_UNCONNECTED_USER = 'request_load_unconnected_user';


    protected SplObjectStorage $clients;

    public function __construct()
    {
        $this->clients = new SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn): void
    {
        $this->clients->attach($conn);
        $queryString = $conn->httpRequest->getUri()->getQuery();
        parse_str($queryString, $queryArray);

        if(isset($queryarray['token']))
        {
            Profile::where('token', $queryArray['token'])->update([ 'connection_id' => $conn->resourceId, 'user_status' => 'Online' ]);

            $user_id = Profile::select('id')->where('token', $queryArray['token'])->get();

            $data['id'] = $user_id[0]->id;

            $data['status'] = 'Online';

            foreach ($this->clients as $client){
                if($client->resourceId != $conn->resourceId)
                {
                    $client->send(json_encode($data));
                }

            }
        }
    }


    public function onMessage(ConnectionInterface $from, $msg): void
    {
        if(preg_match('~[^\x20-\x7E\t\r\n]~', $msg) > 0) {
            $image_name = time() . '.jpg';
            file_put_contents(public_path('/images') . $image_name, $msg);

            $send_data['image_link'] = $image_name;

            foreach($this->clients as $client)
            {
                if($client->resourceId == $from->resourceId)
                {
                    $client->send(json_encode($send_data));
                }
            }
        }

        $data = json_decode($msg);
        if(isset($data->type)) {

            if($data->type === self::REQUEST_LOAD_UNCONNECTED_USER) {
                $user_data = Profile::select('id', 'name', 'last_name', 'online')
                    ->with('image')
                    ->where('id', '!=', $data->from_user_id)
                    ->orderBy('name', 'ASC')
                    ->get();
                $sub_data = [];
                foreach ($user_data as $row) {
                    $sub_data[] = [
                        'name' => $row['name'],
                        'id' => $row['id'],
                        'online' => $row['online'],
                        'image' => $row['image']
                    ];
                }

                $sender_connection_id = Profile::select('connection_id')->where('id', $data->from_user_id)->get();
                $send_data['data'] = $sub_data;
                $send_data[self::REQUEST_LOAD_UNCONNECTED_USER] = true;

                foreach($this->clients as $client)
                {
                    if($client->resourceId == $sender_connection_id[0]->connection_id)
                    {
                        $client->send(json_encode($send_data));
                    }
                }

            }

            if($data->type == 'request_chat_user') {
                $chat_request = new ChatRequest();
                $chat_request->sender_id = $data->from_user_id;
                $chat_request->receiver_id = $data->to_user_id;
                $chat_request->status = 'Pending';
                $chat_request->save();

                $sender_connection_id = Profile::select('connection_id')->where('id', $data->from_user_id)->get();
                $receiver_connection_id = Profile::select('connection_id')->where('id', $data->to_user_id)->get();
                foreach ($this->clients as $client) {
                    if($client->resourceId == $sender_connection_id[0]->connection_id)
                    {
                        $send_data['response_from_user_chat_request'] = true;

                        $client->send(json_encode($send_data));
                    }
                    if($client->resourceId == $receiver_connection_id[0]->connection_id)
                    {
                        $send_data['user_id'] = $data->to_user_id;

                        $send_data['response_to_user_chat_request'] = true;

                        $client->send(json_encode($send_data));
                    }
                }

            }

            if($data->type == 'request_send_message')
            {
                //save chat message in mysql

                $chat = new Chat();

                $chat->sender_id = $data->from_user_id;

                $chat->receiver_id = $data->to_user_id;

                $chat->message = $data->message;

                $chat->readable = false;

                $chat->save();

                $chat_message_id = $chat->id;

                $receiver_connection_id = Profile::select('connection_id')->where('id', $data->to_user_id)->get();

                $sender_connection_id = Profile::select('connection_id')->where('id', $data->from_user_id)->get();

                foreach($this->clients as $client)
                {
                    if($client->resourceId == $receiver_connection_id[0]->connection_id || $client->resourceId == $sender_connection_id[0]->connection_id)
                    {
                        $send_data['chat_message_id'] = $chat_message_id;

                        $send_data['message'] = $data->message;

                        $send_data['from_user_id'] = $data->from_user_id;

                        $send_data['to_user_id'] = $data->to_user_id;

                        if($client->resourceId == $receiver_connection_id[0]->connection_id)
                        {
                            Chat::where('id', $chat_message_id)->update(['readable' => true]);

                            $send_data['message_status'] = 'Send';
                        }
                        else
                        {
                            $send_data['message_status'] = 'Not Send';
                        }

                        $client->send(json_encode($send_data));
                    }
                }
            }

        }
    }

    public function onClose(ConnectionInterface $conn): void
    {
        $this->clients->detach($conn);

        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);

        if(isset($queryarray['token']))
        {
            Profile::where('token', $queryarray['token'])->update([ 'connection_id' => 0, 'online' => false ]);

            $user_id = Profile::select('id', 'updated_at')->where('token', $queryarray['token'])->get();

            $data['id'] = $user_id[0]->id;

            $data['status'] = 'Offline';

            $updated_at = $user_id[0]->updated_at;

            if(date('Y-m-d') == date('Y-m-d', strtotime($updated_at))) //Same Date, so display only Time
            {
                $data['last_seen'] = 'Last Seen at ' . date('H:i');
            }
            else
            {
                $data['last_seen'] = 'Last Seen at ' . date('d/m/Y H:i');
            }

            foreach($this->clients as $client)
            {
                if($client->resourceId != $conn->resourceId)
                {
                    $client->send(json_encode($data));
                }
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        echo "An error has occurred: {$e->getMessage()} \n";

        $conn->close();
    }

}



















