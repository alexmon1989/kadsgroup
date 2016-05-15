<?php

namespace App\Listeners;

use App\Events\OrderWasCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Orchestra\Support\Facades\Memory;

class OrderWasCreatedEventListener
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
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(OrderWasCreatedEvent $event)
    {
        Mail::send('emails.order', ['order' => $event->order], function($message)
        {
            $message->from('info@kadsgroup.com.ua');
            $message->to(Memory::get('site.email_to', 'llckadsgroup@gmail.com'))
                ->subject('Заказ с сайта kadsgroup.com.ua');
        });
    }
}
