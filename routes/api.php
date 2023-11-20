<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\MobileAuthController;
use App\Http\Controllers\Web\DriverController;
use App\Http\Controllers\Mobile\HomeController;
use App\Http\Controllers\Web\DropOffController;
use App\Http\Controllers\Web\ReportsController;
use App\Http\Controllers\Mobile\BookingController;
use App\Http\Controllers\Mobile\HistoryController;
use App\Http\Controllers\Mobile\PendingController;
use App\Http\Controllers\Web\HistoryWebController;
use App\Http\Controllers\Web\RemittanceController;
use App\Http\Controllers\Web\LaundrySettingController;
use App\Http\Controllers\Web\PickupDeliveryController;
use App\Http\Controllers\Web\AdminTransactionController;
use App\Http\Controllers\Mobile\RemittanceMobileController;


Route::prefix('web')->group(function () {

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/refresh', [AuthController::class, 'refresh']);

    Route::middleware(['auth:api'])->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
    Route::get('/getlaundryloads', [LaundrySettingController::class, 'getLaundryLoads']);

    // LAUNDRY SETTING
    Route::get('/getlaundryloads', [LaundrySettingController::class, 'getLaundryLoads']);
    Route::patch('/updatelaundryloads/{id}', [LaundrySettingController::class, 'updateLaundryLoads']);

    Route::get('/getlaundrykilos', [LaundrySettingController::class, 'getLaundryKilos']);
    Route::post('/addlaundrykilo', [LaundrySettingController::class, 'addLaundryKilo']);
    Route::patch('/updatelaundrykilo/{id}', [LaundrySettingController::class, 'updateLaundryKilo']);
    Route::delete('/deletelaundrykilo/{id}', [LaundrySettingController::class, 'deleteLaundryKilo']);

    Route::get('/getservices', [LaundrySettingController::class, 'getServices']);
    Route::post('/addservice', [LaundrySettingController::class, 'addService']);
    Route::patch('/updateservice/{id}', [LaundrySettingController::class, 'updateService']);
    Route::delete('/deleteservice/{id}', [LaundrySettingController::class, 'deleteService']);

    Route::get('/getdetergents', [LaundrySettingController::class, 'getDetergents']);
    Route::post('/adddetergent', [LaundrySettingController::class, 'addDetergent']);
    Route::patch('/updatedetergent/{id}', [LaundrySettingController::class, 'updateDetergent']);
    Route::delete('/deletedetergent/{id}', [LaundrySettingController::class, 'deleteDetergent']);

    Route::get('/getbleaches', [LaundrySettingController::class, 'getBleaches']);
    Route::post('/addbleach', [LaundrySettingController::class, 'addBleach']);
    Route::patch('/updatebleach/{id}', [LaundrySettingController::class, 'updateBleach']);
    Route::delete('/deletebleach/{id}', [LaundrySettingController::class, 'deleteBleach']);

    Route::get('/getbarangays', [LaundrySettingController::class, 'getBarangays']);
    Route::post('/addbarangay', [LaundrySettingController::class, 'addBarangay']);
    Route::patch('/updatebarangay/{id}', [LaundrySettingController::class, 'updateBarangay']);
    Route::delete('/deletebarangay/{id}', [LaundrySettingController::class, 'deleteBarangay']);


    // ADMIN TRANSACTION
    Route::get('/getbookings', [AdminTransactionController::class, 'getBookings']);
    Route::get('/bookingstatus', [AdminTransactionController::class, 'bookingStatus']);
    Route::patch('/updatebooking/{id}', [AdminTransactionController::class, 'updateBooking']);

    // USER
    Route::get('/getusers', [UserController::class, 'getUsers']);
    Route::patch('/updateuser/{id}', [UserController::class, 'updateBlock']);


    // RIDER
    Route::get('/getdrivers', [DriverController::class, 'getDrivers']);
    Route::post('/adddriver', [DriverController::class, 'addDriver']);
    Route::patch('/updatedriver/{id}', [DriverController::class, 'updateDriver']);
    Route::delete('/deleterider/{id}', [DriverController::class, 'deleteRider']);



    // REPORTS
    Route::get('/reports', [ReportsController::class, 'reports']);

    // REMITTANCES
    Route::get('/getremittances', [RemittanceController::class, 'getRemittances']);
    Route::get('/getgcashremittance', [RemittanceController::class, 'getGcashRemittance']);
    Route::get('/getremittancesdropoff', [RemittanceController::class, 'getRemittancesDropoff']);
    Route::get('/getremittanceshistory', [RemittanceController::class, 'getRemittancesHistory']);
    Route::get('/getremittancetotal', [RemittanceController::class, 'remittedTotal']);
    Route::post('/updateremittancestatus/{userID}', [RemittanceController::class, 'updateRemittanceStatus']);

    // HISTORY
    Route::get('/gethistory', [HistoryWebController::class, 'getBookings']);

    // DROP OFF
    Route::post('/adddropoff', [DropOffController::class, 'addDropOff']);
    Route::get('/getdropoff', [DropOffController::class, 'getDropOffName']);
    Route::get('/getdropoffphonenum', [DropOffController::class, 'getDropOffPhoneNum']);

    // PICKUP AND DELIVERY
    Route::get('/getpickupdelivery', [PickupDeliveryController::class, 'getBookings']);
    Route::patch('/updateoutofdelivery/{id}', [PickupDeliveryController::class, 'updateOutOfDelivery']);
});









Route::prefix('mobile')->group(function () {

    Route::post('/register', [MobileAuthController::class, 'register']);
    Route::post('/login', [MobileAuthController::class, 'login']);

    Route::get('/refresh', [MobileAuthController::class, 'refresh']);





    // USER API
    Route::prefix('user')->group(function () {
        Route::middleware(['auth:api'])->group(function () {
            Route::get('/user', [MobileAuthController::class, 'user']);
            Route::post('/logout', [MobileAuthController::class, 'logout']);
        });
        Route::post('/addbooking', [BookingController::class, 'addBooking']);
        Route::get('/bookingstatus', [BookingController::class, 'bookingStatus']);
        Route::post('/userconfirmation/{id}', [BookingController::class, 'userConfirmation']);
        Route::get('/userhistory', [HistoryController::class, 'userHistory']);
    });






    // DRIVER API
    Route::prefix('driver')->group(function () {
        Route::middleware(['auth:api'])->group(function () {
            Route::get('/user', [MobileAuthController::class, 'user']);
            Route::post('/logout', [MobileAuthController::class, 'logout']);
        });
        Route::get('/bookings', [BookingController::class, 'bookings']);
        Route::post('/driverloadtransaction/{id}', [BookingController::class, 'driverLoadTransaction']);
        Route::post('/driverkilotransaction/{id}', [BookingController::class, 'driverKiloTransaction']);
        Route::post('/driverloadkilotransaction/{id}', [BookingController::class, 'driverLoadKiloTransaction']);
        Route::get('/driverdelivery', [BookingController::class, 'driverDelivery']);
        Route::post('/driversuccess/{id}', [BookingController::class, 'driverSuccess']);
        Route::get('/riderhistory', [HistoryController::class, 'riderHistory']);
        Route::get('/collectionhistory', [HistoryController::class, 'collectionHistory']);
        Route::get('/riderremitted', [HistoryController::class, 'riderRemitted']);
        Route::get('/getremittances', [RemittanceMobileController::class, 'getRemittances']);

        Route::get('/bookingstatus', [HomeController::class, 'bookingStatus']);
    });
});

