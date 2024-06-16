<?php

namespace App\Console\Commands;

use App\Classes\Sockets\ChatSocket;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class WebSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    public function handle(): void
    {
        $this->info('server start');
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new ChatSocket()
                )
            ),
            8080
        );
        $server->run();
    }
}
