<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Fallback Route For All Invalid Routes


Route::group(['middleware' => ['cors', 'json.response']], function () {

  
    //Merchant Registration
    Route::post('/register' , 'Api\LoginRegisterController@register');
    //Merchant Login
    Route::post('/login' , 'Api\LoginRegisterController@login');
    //Generate And Send OTP
    Route::post('/SendOtp', 'Api\OtpManagerController@OtpGeneration');
    //Verify OTP
    Route::post('/VerifyOtp', 'Api\OtpManagerController@OtpVerification');
    //Forget password
    Route::post('/forgetPassword', 'Api\LoginRegisterController@forgetPassword');
    //Get Support Question details
    Route::get('/supportQuestion', 'Api\ManageSupportRequestController@getSupportQuestion');
    
    //========================================== Bearer Api's===================================================
    
    Route::group(['middleware' => 'auth:api'], function(){
        //Merchant Details
        Route::get('/details', 'Api\LoginRegisterController@details');
        //Merchant logout
        Route::get('/logout', 'Api\LoginRegisterController@logout');
        //User Login details updation
        Route::post('/profileUpdate', 'Api\LoginRegisterController@updateLogin');
        //Merchant Business details Create And Update
        Route::post('/businessDetails', 'Api\BusinessDetailsController@createUpdateMerchantDetails');
        //Merchant GET Business details 
        Route::get('/businessDetails', 'Api\BusinessDetailsController@businessDetails');
        //Get Sender Wallet Details
        Route::get('/qrDetails', 'Api\WalletTransactionController@qrDetails');
        //Pay money through wallet
        Route::post('/payMoney', 'Api\WalletTransactionController@payMoney');
        //get all Transactions details
        Route::get('/getTransactions', 'Api\WalletTransactionController@getTransactionsData');
        //wallet details
        Route::get('/getWallet', 'Api\WalletTransactionController@getWalletData');
        //wallet Add Money
        Route::post('/addWalletMoney', 'Api\WalletTransactionController@addMoney');
        //Create Support Query
        Route::post('/supportQuery', 'Api\ManageSupportRequestController@createSupportQueries');
        //Merchant GET Qr 
        Route::get('/qr', 'Api\BusinessDetailsController@imageQrCode');
        //User Device token updation
        Route::post('/updateDeviceToken', 'Api\LoginRegisterController@updateDeviceToken');
        //User Device token updation
        Route::get('/getNotifications', 'Api\NotificationManageController@getNotifications');
        //wallet Voucher Add Money
        Route::post('/voucherAddMoney', 'Api\WalletTransactionController@voucherAddMoney');

        
    });
    // ...
});