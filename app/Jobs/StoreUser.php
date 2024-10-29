<?php

namespace App\Jobs;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class StoreUser implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        event(new Registered($this->user));
    }
}
