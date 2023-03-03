<?php

namespace App\Listeners;

use App\Events\userCanceledOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateAddingItemsInStock
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\userCanceledOrder  $event
     * @return void
     */
    public function handle(userCanceledOrder $event)
    {
        //
    }
}
