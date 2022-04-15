<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReportController;

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
//        Route::resource('/smsSetting', 'SystemSetting\SmsSettingController');
//        Route::resource('/otpSetting', 'SystemSetting\OtpSettingController');
        Route::resource('/loginSetting', 'SystemSetting\LoginSettingController');
//        Route::resource('/registerSetting', 'SystemSetting\RegisterSettingController');
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
        Route::resource('/fiscalYear', 'Configurations\FiscalYearController');
        Route::post('/fiscalYear/status/{id}', 'Configurations\FiscalYearController@status');
    });
    Route::prefix('/general/info')->group(function (){
        Route::get('/','GeneralInformationController@index');
        Route::get('/create','GeneralInformationController@create');
        Route::post('/store','GeneralInformationController@store');
        Route::get('/edit/{id}','GeneralInformationController@edit');
        Route::put('/update/{id}','GeneralInformationController@update');
        Route::delete('/destroy/{id}','GeneralInformationController@destroy');
        Route::get('/{id}','GeneralInformationController@show');
    });

    Route::prefix('/general/dispatch')->group(function (){
        Route::get('/','GeneralDispatchController@index');
        Route::get('/create','GeneralDispatchController@create');
        Route::post('/store','GeneralDispatchController@store');
        Route::get('/edit/{id}','GeneralDispatchController@edit');
        Route::put('/update/{id}','GeneralDispatchController@update');
        Route::delete('/destroy/{id}','GeneralDispatchController@destroy');
        Route::get('/{id}','GeneralDispatchController@show');
    });

    Route::prefix('/report')->group(function (){
        Route::get('/general/dispatch',[ReportController::class,'generalDispatch']);
        Route::get('/general/registration',[ReportController::class,'generalRegistration']);
    });

});