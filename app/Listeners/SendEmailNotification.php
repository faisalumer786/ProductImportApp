<?php

namespace App\Listeners;

use App\Events\ProductInserted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\DuplicateSkuNotification;

class ProductInsertedListener implements ShouldQueue
{
    public function handle(ProductInserted $event)
    {
        $newProductSku = $event->product->sku;
        $existingProduct = Product::where('sku', $newProductSku)->first();

        if ($existingProduct) {
            // Send email notification
            Mail::to($event->userEmail)->send(new DuplicateSkuNotification($newProductSku));
        }
    }
}