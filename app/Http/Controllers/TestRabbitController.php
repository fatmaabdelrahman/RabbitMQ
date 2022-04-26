<?php

namespace App\Http\Controllers;

use App\Jobs\testJob;
use App\Models\User;
use Illuminate\Http\Request;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class TestRabbitController extends Controller
{
    public function index(){
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('adam', false, false, false, false);
        $msg = new AMQPMessage('Hello Fatma!');
        $channel->basic_publish($msg, '', 'adam');

        echo " [x] Sent 'Hello World!'\n";

        $channel->close();
        $connection->close();
    }

    public function queueDeclare(){
//        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $result = ($channel->basic_get('adam', true, null)->body);
        return $result;
    }
}
