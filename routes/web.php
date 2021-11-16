<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('reload-captcha', 'Auth\LoginController@reloadCaptcha');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    Route::prefix('roles')->group(function () {
        Route::resource('/menu', 'Roles\MenuController');
        Route::post('/menu/menuControllerChangeStatus/{id}', 'Roles\MenuController@status');
        Route::resource('/type', 'Roles\UserTypeController');
        Route::post('/type/status/{id}', 'Roles\UserTypeController@status');
        Route::get('/userTypeRoleAccess', 'Roles\RoleAccessController@index');
        Route::get('userTypeRoleChangeAccess/{allowId}/{id}', 'Roles\RoleAccessController@changeAccess');
    });
    Route::resource('/users', 'UserController');
    Route::post('/users/status/{id}', 'UserController@status');
    Route::post('/users/block_status/{id}', 'UserController@block_status');
    Route::get('/my-profile', 'UserController@profile')->name('profile');
    Route::post('profile/profilePic', 'UserController@profilePic');
    Route::post('profileUpdate', 'UserController@updateProfile');
    Route::post('/updatePassword', 'UserController@updatePassword');
    Route::get('/my-activity', 'HomeController@myActivity');

    Route::prefix('logs')->group(function () {
        Route::resource('/loginLogs', 'Logs\LoginLogsController');
        Route::resource('/failLoginLogs', 'Logs\FailedLoginLogsController');
        Route::resource('/actionLogs', 'Logs\ActionLogsController');
        Route::post('/ip_block/{id}', 'Logs\FailedLoginLogsController@ip_unblock');
    });

    Route::prefix('systemSetting')->group(function () {
        Route::resource('/appSetting', 'SystemSetting\AppSettingController');
        Route::resource('/mailSetting', 'SystemSetting\EmailSettingController');
        Route::resource('/smsSetting', 'SystemSetting\SmsSettingController');
        Route::resource('/otpSetting', 'SystemSetting\OtpSettingController');
        Route::resource('/loginSetting', 'SystemSetting\LoginSettingController');
        Route::resource('/registerSetting', 'SystemSetting\RegisterSettingController');
        Route::post('/uploadSystemSettingFile/{id}', 'SystemSetting\AppSettingController@uploadFile');
        Route::post('/updateStatus/{id}', 'SystemSetting\LoginSettingController@updateStatus');
        Route::resource('/officeType', 'Configurations\OfficeTypeController');
        Route::post('/officeType/status/{id}', 'Configurations\OfficeTypeController@status');
        Route::resource('/office', 'Configurations\OfficeController');
        Route::post('/office/status/{id}', 'Configurations\OfficeController@status');
        Route::resource('/city', 'Configurations\CityController');
        Route::post('/city/status/{id}', 'Configurations\CityController@status');
        Route::resource('/designation', 'Configurations\DesignationController');
        Route::post('/designation/status/{id}', 'Configurations\DesignationController@status');
        Route::resource('/productCategory', 'Configurations\ProductCategoryController');
        Route::post('/productCategory/status/{id}', 'Configurations\ProductCategoryController@status');
        Route::resource('/sourceQuery', 'Configurations\SourceQueryController');
        Route::post('/sourceQuery/status/{id}', 'Configurations\SourceQueryController@status');
        Route::resource('/paymentMethod', 'Configurations\PaymentMethodController');
        Route::post('/paymentMethod/status/{id}', 'Configurations\PaymentMethodController@status');
        Route::resource('/fiscalYear', 'Configurations\FiscalYearController');
        Route::post('/fiscalYear/status/{id}', 'Configurations\FiscalYearController@status');
    });
    Route::resource('/campaign', 'CampaignController');
    Route::resource('/product', 'ProductController');
    Route::resource('/customer', 'CustomerController');
    Route::post('/customerUpdateStatus', 'CustomerController@statusChange');
    Route::get('/customer/purchaseproduct/{id}','PurchaseProductController@index')->name('purchaseProduct.index');
    Route::post('/customer/purchaseproduct/store/{id}','PurchaseProductController@store')->name('purchaseProduct.store');
    Route::get('/customer/purchaseproduct/edit/{cusId}/{id}','PurchaseProductController@edit')->name('purchaseProduct.edit');
    Route::put('/customer/purchaseproduct/update/{cusId}/{id}','PurchaseProductController@update')->name('purchaseProduct.update');
    Route::delete('/customer/purchaseproduct/delete/{cusId}','PurchaseProductController@destroy')->name('purchaseProduct.delete');
    Route::resource('/query', 'CustomerQueryController');
    Route::resource('/payment', 'PaymentController');
    Route::resource('/followup', 'CustomerFollowupController');
    Route::resource('/notice', 'NoticeController');
    Route::post('/notice/status/{id}', 'NoticeController@statusChange');

    Route::prefix('report')->group(function () {
        Route::resource('/officeWiseReport', 'Report\OfficeWiseReportController');
        Route::resource('/productWiseSellReport', 'Report\ProductWiseReportController');
    });
    //mobile app user
    Route::get('/appUser', 'AppUserController@index');
    Route::get('/appUser/{id}', 'AppUserController@show')->name('appUser.show');
    Route::delete('/appUser/{id}', 'AppUserController@destroy')->name('appUser.destroy');
    Route::get('/appUser/approve/{id}', 'AppUserController@approvedUser');
    Route::get('/dsr','DailySalesReportController@index')->name('dsr');
    Route::get('/dsr/{id}/clients','DailySalesReportController@clients')->name('dsr.clients');
    Route::get('/dsr/{id}','DailySalesReportController@show')->name('dsr.show');
    Route::post('/dsr/changestatus','DailySalesReportController@statusChange')->name('dsr.changestatus');

    Route::get('appUser/{id}/leaves','AppUserLeaveController@index');
    Route::post('appUser/{id}/leaves','AppUserLeaveController@store');

});