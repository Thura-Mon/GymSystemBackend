<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    Mail::raw('This is a test email from Laravel SMTP setup.', function ($message) {
        $message->to('thuramon086@gmail.com')
                ->subject('Test Email');
    });

    return 'Email Sent!';
});

