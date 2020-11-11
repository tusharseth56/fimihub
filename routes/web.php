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
         //Change password Page
         Route::get('changePassword', 'Web\Customer\UserController@getChangePasswordPage');
         //Change password Process
         Route::post('changePassword', 'Web\Customer\UserController@changePassword');
         //Contact Us Page
         Route::get('contactUs', 'Web\Customer\UserController@getContactUsPage');
         //Contact Us Process
         Route::post('contactUs', 'Web\Customer\UserController@contactUs');
         //Saved Address Page
         Route::get('saveaddress', 'Web\Customer\UserController@getSaveAddressPage');
         //My Order Page
         Route::get('myOrder', 'Web\Customer\UserController@getMyOrderPage');
         //Terms and condition Page
         Route::get('termsCondition', 'Web\Customer\UserController@getTermsConditionPage');
         //Terms and condition Page
         Route::get('FAQ', 'Web\Customer\UserController@getFaqPage');
         //Legal Information Page
         Route::get('legalInformation', 'Web\Customer\UserController@getLegalInformationPage');
         //AboutUs Page
         Route::get('aboutUs', 'Web\Customer\UserController@getAboutUsPage');
         //AboutUs Page
         Route::get('restaurentDetails', 'Web\Customer\RestaurentController@getRestaurentDetails');

      });


//========================================== Restaurent Routes ===================================================

      //Restaurent Login
      Route::get('/Restaurent/login', function () {
         return view('restaurent.auth.login');
      });
      // Restaurent Login Process
      Route::post('Restaurent/login', 'Web\Restaurent\LoginRegisterController@login');
      // Restaurent Logout
      Route::get('Restaurent/logout', 'Web\Restaurent\LoginRegisterController@logout');
      // Signin Otp Verification
      Route::post('Restaurent/verifyOtp', 'Web\Restaurent\LoginRegisterController@verifyOtp');
      // Resend Otp
      Route::get('/resendOtp', 'Web\Restaurent\LoginRegisterController@resendOtp');
      
      //========================================== Session RestaurentAuth Routes ===================================================

      Route::group(['middleware' => 'restaurentauth', 'prefix'=>'Restaurent'],function () {
         
         // Restaurent Dasboard
         Route::get('dashboard', 'Web\Restaurent\DashboardController@dashboardDetails');
         // Restaurent Details
         Route::get('myDetails', 'Web\Restaurent\RestaurentController@accountDetails');
         // Restaurent Details update or insert
         Route::post('addRestaurentDetails', 'Web\Restaurent\RestaurentController@addRestaurentDetails');
         // Menu Category
         Route::get('menuCategory', 'Web\Restaurent\RestaurentController@categoryDetails');
         // Menu Category update or insert
         Route::post('addCategory', 'Web\Restaurent\RestaurentController@addCategoryProcess');
         // Menu List
         Route::get('menuList', 'Web\Restaurent\RestaurentController@getMenuList');
         // Menu Category update or insert
         Route::post('addMenu', 'Web\Restaurent\RestaurentController@menuListProcess');

         
      });












   //========================================== Admin Routes ===================================================

      //Admin Login
      Route::get('/adminfimihub/login', function () {
         return view('admin.auth.login');
      });
      // Admin Login Process
      Route::post('adminfimihub/login', 'Web\Admin\LoginRegisterController@login');
      // Admin Logout
      Route::get('adminfimihub/logout', 'Web\Admin\LoginRegisterController@logout');

      //========================================== Session AdminAuth Routes ===================================================

      Route::group(['middleware' => 'adminauth', 'prefix'=>'adminfimihub'], function () {
         
         // Admin Dasboard
         Route::get('dashboard', 'Web\Admin\DashboardController@dashboardDetails');

         // Admin User List
         Route::get('restaurentList', 'Web\Admin\RestaurentController@RestaurentListDetails');
         // Add Restaurent page
         Route::get('addRestaurent', 'Web\Admin\RestaurentController@RestaurentListDetails');
         // Add Restaurent page Process
         Route::post('addRestaurent', 'Web\Admin\RestaurentController@addRestaurentProcess');
         // Menu Category
         Route::get('menuCategory', 'Web\Admin\RestaurentController@categoryDetails');
         // Menu Category update or insert
         Route::post('addCategory', 'Web\Admin\RestaurentController@addCategoryProcess');
         
      });

});

