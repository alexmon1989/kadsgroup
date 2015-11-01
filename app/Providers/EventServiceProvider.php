<?php

namespace App\Providers;

use App\ProductSfs;
use App\ProductSika;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\File;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        // Событие удаления продукта Sika
        ProductSika::deleting(function($product)
        {
            // Удаляем изображение и техкарту

            if ($product->photo) {
                $imgPath = public_path('assets' . DIRECTORY_SEPARATOR
                    . 'img' . DIRECTORY_SEPARATOR
                    . 'products' . DIRECTORY_SEPARATOR
                    . 'sika' . DIRECTORY_SEPARATOR
                    . $product->photo);

                if (file_exists($imgPath)) {
                    File::delete($imgPath);
                }
            }

            if ($product->tech_cart_file) {
                $techCartPath = public_path('assets' . DIRECTORY_SEPARATOR
                    . 'img' . DIRECTORY_SEPARATOR
                    . 'products' . DIRECTORY_SEPARATOR
                    . 'sika' . DIRECTORY_SEPARATOR
                    . 'tech-carts' . DIRECTORY_SEPARATOR
                    . $product->tech_cart_file);

                if (file_exists($techCartPath)) {
                    File::delete($techCartPath);
                }
            }

            return TRUE;
        });

        // Событие удаления продукта Primer
        ProductSika::deleting(function($product)
        {
            // Удаляем изображение и техкарту

            if ($product->photo) {
                $imgPath = public_path('assets' . DIRECTORY_SEPARATOR
                    . 'img' . DIRECTORY_SEPARATOR
                    . 'products' . DIRECTORY_SEPARATOR
                    . 'primer' . DIRECTORY_SEPARATOR
                    . $product->photo);

                if (file_exists($imgPath)) {
                    File::delete($imgPath);
                }
            }

            return TRUE;
        });

        // Событие удаления продукта Sfs
        ProductSfs::deleting(function($product)
        {
            // Удаляем PDF

            if ($product->file_name) {
                $filePath = public_path('assets' . DIRECTORY_SEPARATOR
                    . 'img' . DIRECTORY_SEPARATOR
                    . 'products' . DIRECTORY_SEPARATOR
                    . 'sfs' . DIRECTORY_SEPARATOR
                    . $product->file_name);

                if (file_exists($filePath)) {
                    File::delete($filePath);
                }
            }

            return TRUE;
        });
    }
}
