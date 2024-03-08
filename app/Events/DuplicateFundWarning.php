<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DuplicateFundWarning
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    use Dispatchable, SerializesModels;

    public string $message;

    public function __construct($message)
    {
        $this->message = $message;
    }
}
