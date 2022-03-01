<?php

namespace App\Providers;

use App\Models\SalesItem;
use App\Models\PurchaseItem;
use App\Observers\SalesItemObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Observers\PurchaseItemObserver;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    public function boot(): void
    {
        PurchaseItem::observe(PurchaseItemObserver::class);
        SalesItem::observe(SalesItemObserver::class);
    }
}
