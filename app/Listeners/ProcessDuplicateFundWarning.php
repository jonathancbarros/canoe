<?php

namespace App\Listeners;

use App\Events\DuplicateFundWarning;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ProcessDuplicateFundWarning
{
    use InteractsWithQueue;

    public function handle(DuplicateFundWarning $event): void
    {
        Log::warning('Warning: ' . $event->message);
    }
}
