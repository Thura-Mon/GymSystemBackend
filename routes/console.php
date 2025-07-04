<?php

use App\Models\Member;
use App\Models\Seller;
use App\Models\Purchase;
use App\Models\Cash;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use League\CommonMark\Extension\Attributes\Node\Attributes;

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


// Creating Purchase Records
Artisan::command('app:create-purchases', function(){
    $purchase = Purchase::create(attributes :[
        'p_id' => 3,
        'p_month' => "3",
        'p_amount' => "85000",
        'p_expiration' => 111,
    ]);
    $this->info("Created one purchase's record successfully");

});


Artisan::command('app:delete-purchases', function () {
    $deleted = Purchase::where([
        'p_id' => 1,
        'p_month' => "1",
        'p_amount' => "35000",
        'p_expiration' => 45,
    ])->delete();

    if ($deleted) {
        $this->info("Deleted $deleted purchase record(s) successfully.");
    } else {
        $this->warn("No matching purchase records found to delete.");
    }
});



// cash Transaction

Artisan::command('app:create-cash-transaction', function () {
    $cashTransaction = \App\Models\CashTransaction::create([
        'ct_id' => 3, 
        'ct_type' => 'Cash',
        'c_flag' => 3,
        'ct_total' =>0,
    ]);

})->purpose('Create a cash transaction record');



Artisan::command('app:delete', function () {
    $deletedCount = Cash::truncate();
    $this->info("Sellers table truncated. Deleted records.");
})->purpose('Truncate the sellers table');