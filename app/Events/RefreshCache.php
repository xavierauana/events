<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RefreshCache extends Event
{
    use SerializesModels;

    public $object;
    public $action;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($object, $action)
    {
        $this->action = strtolower($action);
        $this->object = strtolower($object);
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
