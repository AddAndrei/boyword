<?php

namespace App\Classes\Sockets\Base;

use App\Http\Controllers\Controller;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class BaseSocket extends Controller implements MessageComponentInterface
{

    function onOpen(ConnectionInterface $conn)
    {
        // TODO: Implement onOpen() method.
    }

    function onClose(ConnectionInterface $conn)
    {
        // TODO: Implement onClose() method.
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        // TODO: Implement onError() method.
    }

    function onMessage(ConnectionInterface $from, $msg)
    {
        // TODO: Implement onMessage() method.
    }
}
