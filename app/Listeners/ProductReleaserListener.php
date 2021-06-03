<?php

namespace App\Listeners;

use App\Events\ProductReleaser;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class ProductReleaserListener implements ShouldQueue
{

    use InteractsWithQueue;

    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'database';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'product_releaser';

    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 25;


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
     * @param  ProductReleaser  $event
     * @return void
     */
    public function handle(ProductReleaser $event)
    {
        session()->flash('error', "attention the product named {$event->cart->title} has been released.");
        Cart::remove($event->cart->rowId);
    }
}
