<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['cors', 'json.response']], function () {

//========================================== Merchant Routes ===================================================

      // Merchant Root Page
      Route::get('/', function () {
         return view('merchant.auth.login');
      });
      // Merchant Login
      Route::get('/merchant/login', function () {
         return view('merchant.auth.login');
      });
      // Merchant Register
      Route::get('merchant/register', function () {
         return view('merchant.auth.register');
      });
      // Merchant Forget Password
      Route::get('merchant/forgetPassword', function () {
         return view('merchant.auth.forgetPassword');
      });
      // Merchant Forget Password Process
      Route::post('merchant/forgetPasswordProcess', 'Web\Merchant\LoginRegisterController@forgetPasswordProcess');
      // Merchant Forget Password
      Route::get('merchant/passwordChangeVerification', function () {
         return view('merchant.auth.otpVerification');
      });
      
      // Merchant Forget Password Verification Process
      Route::post('merchant/passwordVerification', 'Web\Merchant\LoginRegisterController@forgetPassword');
      // Merchant Register Process
      Route::post('merchant/register', 'Web\Merchant\LoginRegisterController@register');
      // Merchant Login Process
      Route::post('merchant/login', 'Web\Merchant\LoginRegisterController@login');
      // Resend OTP
      Route::get('merchant/resendOTP', 'Web\Merchant\LoginRegisterController@resendOtp');
      // Verify OTP
      Route::post('merchant/verifyOtp', 'Web\Merchant\LoginRegisterController@verifyOtp');
      // Merchant Logout
      Route::get('merchant/logout', 'Web\Merchant\LoginRegisterController@logout');

      //========================================== Session MerchantAuth Routes ===================================================

      Route::group(['middleware' => 'merchantauth'], function () {
         //Merchant dashboard
         Route::get('merchant/dashboard', 'Web\Merchant\DashboardController@dashboardDetails');
         //Merchant Qr Page
         Route::get('merchant/qr', 'Web\Merchant\QrController@qrDetails');
         //Merchant Bussiness details
         Route::get('merchant/businessDetails', 'Web\Merchant\BusinessController@businessDetails');
         //Merchant Otp Verfiy
         Route::get('merchant/verify', function () {
            return view('merchant.verfifyOtp');
         });
         // Merchant Business Details Form
         Route::get('merchant/businessForm', 'Web\Merchant\BusinessController@businessFormDetails');
         // Merchant Address Form
         Route::get('merchant/addressForm', function () {
            return view('merchant.addressDetails');
         });
         // Merchant Sub Category
         Route::get('merchant/subcategory/{id}','Web\Merchant\CategoryManageController@getSubCategories');
         // Merchant Category
         Route::get('merchant/category/','Web\Merchant\CategoryManageController@getCategories');
         
         //Merchant Bussiness details create and update
         Route::post('merchant/businessDetailProcess', 'Web\Merchant\BusinessController@createUpdateMerchantDetails');
         //Merchant Address details create and update
         Route::post('merchant/addressDetailProcess', 'Web\Merchant\BusinessController@createUpdateMerchantAddressDetails');
         //Merchant GET Qr download
         Route::get('merchant/qrDownload', 'Web\Merchant\BusinessController@imageQrCode');
      
   });




   //========================================== Admin Routes ===================================================

      //Admin Login
      Route::get('/adminQbeez/login', function () {
         return view('admin.auth.login');
      });
      // Admin Login Process
      Route::post('adminQbeez/login', 'Web\Admin\LoginRegisterController@login');
      // Admin Logout
      Route::get('adminQbeez/logout', 'Web\Admin\LoginRegisterController@logout');

      //========================================== Session AdminAuth Routes ===================================================

      Route::group(['middleware' => 'adminauth'], function () {
         
         // Admin Dasboard
         Route::get('adminQbeez/dashboard', 'Web\Admin\DashboardController@dashboardDetails');
         // Admin User List
         Route::get('adminQbeez/userList', 'Web\Admin\UserManageController@UserListDetails');
         // Admin User List in details
         Route::get('adminQbeez/userDetails', 'Web\Admin\UserManageController@UserDetails');
         // Admin User Update details
         Route::post('adminQbeez/userUpdate', 'Web\Admin\UserManageController@UserUpdateDetails');
         // Admin Merchant List
         Route::get('adminQbeez/merchantList', 'Web\Admin\MerchantManageController@MerchantListDetails');
         // Admin Merchant List in details
         Route::get('adminQbeez/merchantDetails', 'Web\Admin\MerchantManageController@MerchantDetails');
         // Admin Merchant Update details
         Route::post('adminQbeez/merchantUpdate', 'Web\Admin\MerchantManageController@MerchantUpdateDetails');
         // Admin User Wallet List
         Route::get('adminQbeez/userWalletList', 'Web\Admin\UserManageController@UserWalletListDetails');
         // Admin Merchant Wallet List
         Route::get('adminQbeez/merchantWalletList', 'Web\Admin\MerchantManageController@MerchantWalletListDetails');
         // Admin Voucher List
         Route::get('adminQbeez/voucherList', 'Web\Admin\VoucherManagerContoller@VocherListDetails');
         
      });

});

