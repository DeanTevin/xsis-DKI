<?php

namespace App\Containers\AppSection\Master\Events;

use App\Containers\AppSection\Master\Models\Master;
use App\Ship\Parents\Events\Event as ParentEvent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;

class MasterUpdatedEvent extends ParentEvent
{
    public function __construct(
        public readonly Master $master,
    ) {
    }

    /**
     * @return Channel[]
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
