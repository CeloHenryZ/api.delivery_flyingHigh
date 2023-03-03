<?php

namespace App\Listeners;

use App\Events\userOderedItems;
use App\Services\ProductStockManagerService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateRemovingItemsInStock
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
     * @param userOderedItems $event
     * @return void
     */
    public function handle(userOderedItems $event)
    {
        (new ProductStockManagerService($event->itensPedido))->removeFromStockProductsWithSize();
    }
}
