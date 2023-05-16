<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Chat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $data, $sendTo, $channel, $data_to, $route;
    // public $username, $message;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data['data'];
        $this->sendTo = $data['send_to'];
        $this->channel = $data['channel'];
        $this->data_to = $data['data_to'];
        $this->route = $data['route'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->channel);
    }

    public function broadcastAs()
    {
        return $this->sendTo;
    }

    public function broadcastWith()
    {
        return [
            'data' => $this->data,
            'send_to' => $this->sendTo, 
            'channel' => $this->channel,
            'data_to' => $this->data_to,
            'route' => $this->route 
        ];
    }
}
