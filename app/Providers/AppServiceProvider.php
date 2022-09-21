<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Catagory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('setting', User::first());
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject(' Email Address')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
        });
    }
}
