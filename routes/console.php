<?php

use App\Models\Seller;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('app:install-super-admin', function () {
    dd(Seller::where('id',1)->get());
});

// Artisan::command('app:delete-super-admin', function () {
//     dd(Seller::query()->delete());
// });


Artisan::command('app:truncate-sellers', function () {
    $deletedCount = Seller::truncate();
    $this->info("Sellers table truncated. Deleted records.");
})->purpose('Truncate the sellers table');

Artisan::command('app:create-super-admin', function () {
    $seller = Seller::create(attributes: [
        'name' => 'gymadmin',
        'password' => Hash::make('password123'),
    ]);

    $this->info("Super Admin created with ID: {$seller->id}");
})->purpose('Create a super admin user');