<?php

namespace App\Providers\App\Listners;

use App\Events\ProductsWithZeroQuantity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InactivateProducts
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
     * @param  \App\Events\ProductsWithZeroQuantity  $event
     * @return void
     */
    public function handle(ProductsWithZeroQuantity $event)
    {
        //
    }
}
