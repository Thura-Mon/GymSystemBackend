<?php

use App\Http\Controllers\Owner\AccountController;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\AuthController;
use App\Http\Controllers\Owner\BodyBuilderController;
use App\Http\Controllers\Owner\CashController;
use App\Http\Controllers\Owner\MemberController;
use App\Http\Controllers\Owner\PurchaseController;
use App\Models\BodyBuilder;
use App\Models\MemberDay;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;

Route::post('/login',[AuthController::class, 'login'])->middleware(); // Admin Authentication

Route::post('/add-members', [MemberController::class, 'addMember']); // Add / Register a new member

Route::post('/get-member-lists', [MemberController::class, 'memberAndCash']); // get member and cash

Route::post('/get-active-members', [MemberController::class, 'getActiveMember']); // Get Active members

Route::post('/get-inactive-members', [MemberController::class, 'getInactiveMember']); // Get Inactive members

Route::post('/get-expired-members', [MemberController::class, 'getExpiredMember']); // Get Expired members

Route::post('/update-member', [MemberController::class, 'updateMember']); // update a member

Route::post('/delete-member', [MemberController::class, 'deleteMember']); // delete a member

Route::post('/total-members', [MemberController::class, 'totalMembers']); // Total members count

Route::post('/total-active-members', [MemberController::class, 'totalActiveMembers']); // Total active members count

Route::post('/total-inactive-members', [MemberController::class, 'totalInactiveMembers']); // Total inactive members count

Route::post('add-body-builder', [BodyBuilderController::class, 'insertbodybuilder']); // Add Body Builder

Route::post('/get-body-builder', [BodyBuilderController::class, 'getbodybuilder']); // Retrieve / Get body builder

Route::post('/total-body-builder', [BodyBuilderController::class, 'totalBodyBuilder']); // Total Body Builder

Route::post('/member-status', [MemberController::class, 'memberstatuslist']); // Lists of member status

Route::post('/delete-body-builder', [BodyBuilderController::class, 'deletebodybuilder']); // Delete Body Builder

Route::post('/update-body-builder', [BodyBuilderController::class, 'updatebodybuilder']); // Update Body Builder

Route::post('/purchase-plans', [PurchaseController::class, 'viewPurchase']); // Purchase Plan

Route::post('/add-purchase-plan', [PurchaseController::class, 'addNewPurchasePlan']); // Add new Purchase Plan

Route::get('/update-purchase-plan', [PurchaseController::class, 'updatePlanAmount']); // Update Purchase Plan amount

Route::post('view-cash', [CashController::class, 'getCash']); // View CashTransaction

Route::post('/cash-transaction', [AccountController::class, 'cash_transaction']); // Account Cash Transaction

Route::post('/get-total-transaction', [AccountController::class, 'totalTransaction']); // Get the total Transaction

Route::post('/get-transaction-info', [AccountController::class, 'getTransactionInfo']); // Get Transaction Info

Route::get('/sellers', function () {
    $sellers = \App\Models\Seller::first();
    return response()->json([
        'sellers' => $sellers->name
    ]);
});



Route::get('/', function (Request $request) {

    echo "Welcome Seller";


});

// Route::get('/verify-otp', function (Request $request) {
//     $email = $request->input("m_email");
//     $otp = rand(100000, 999999);
//     Mail::to($email)->send(
//         new \App\Mail\VerifyOTP($otp));
//     return view('emails.verify_otp',['otp' => $otp]);
//     });


