<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Transport\Dsn;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Mail::extend('brevo', function () {
            return new \App\Mail\Transport\BrevoTransport(
                new Client(),
                config('mail.mailers.brevo.key')
            );
        });
    }
} 