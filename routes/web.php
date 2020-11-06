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

Route::group(['middleware' => ['cors', 'json.response']], function () {

//========================================== Customer Routes ===================================================

      // Customer Root Page
      Route::get('/', function () {
         return view('customer.index');
      });
      // Customer Login
      Route::get('/login', function () {
         return view('customer.auth.login');
      });
      // Customer Register
      Route::get('/register', function () {
         return view('customer.auth.register');
      });
      // Customer Login Process
      Route::post('/loginProcess', 'Web\Customer\LoginRegisterController@login');
      // Customer Register Process
      Route::post('/registerProcess', 'Web\Customer\LoginRegisterController@register');
      // Resend OTP
      Route::get('/resendOTP', 'Web\Customer\LoginRegisterController@resendOtp');
      // Signup Otp Verification
      Route::post('/verifyOtp', 'Web\Customer\LoginRegisterController@verifyOtp');
      // Send OTP
      Route::post('/getOTP', 'Web\Customer\LoginRegisterController@sendOtp');
      // Signup Otp Verification
      Route::post('/verifyAccount', 'Web\Customer\LoginRegisterController@verifyForgetPasswordOtp');
      // Customer Forget Password Process
      Route::post('/forgetPasswordProcess', 'Web\Customer\LoginRegisterController@forgetPassword');
      // Signin Otp Verification
      Route::post('/verifyOtpLogin', 'Web\Customer\LoginRegisterController@verifyOtpLogin');
      // Customer Logout
      Route::get('logout', 'Web\Customer\LoginRegisterController@logout');
      // Customer Subscribed
      Route::post('subscribeProcess', 'Web\Customer\DashboardController@subscribe');
      

      //========================================== Session Customer Auth Routes ===================================================

      Route::group(['middleware' => 'customerauth'], function () {

         //Customer dashboard
         Route::get('/home', 'Web\Customer\DashboardController@index');
         //Cart Page
         Route::get('/cart', 'Web\Customer\CartController@index');
         // Save Addresss
         Route::post('saveAddress', 'Web\Customer\AddressController@insertAddress');
         // Save Addresss
         Route::get('myAccount', 'Web\Customer\UserController@index');
         //Update Profile
         Route::post('updateProfile', 'Web\Customer\UserController@updateProfile');


      });













      
      // Merchant Forget Password
      Route::get('merchant/forgetPassword', function () {
         return view('merchant.auth.forgetPassword');
      });
      
      // Merchant Forget Password
      Route::get('merchant/passwordChangeVerification', function () {
         return view('merchant.auth.otpVerification');
      });
      
      // Merchant Forget Password Verification Process
      Route::post('merchant/passwordVerification', 'Web\Merchant\LoginRegisterController@forgetPassword');
      
      
      
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

