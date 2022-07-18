<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
// frontend routes
Route::get('/', 'Frontend\MainController@index');
Route::get('/films', 'Frontend\FilmController@index');
Route::get('/films/{id}', 'Frontend\FilmController@view');
Route::get('/photos', 'Frontend\PhotoController@index');
Route::get('/photos/{id}', 'Frontend\PhotoController@view');
Route::get('/identity', 'Frontend\IdentityController@index');
Route::get('/identity/{id}', 'Frontend\IdentityController@view');
Route::post('/user/message', 'Frontend\MainController@storeMessage');
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

    Route::prefix('admin')->group(function () {
        Route::resource('/pages', 'Admin\PageController');
        Route::post('/pages/status/{id}', 'Admin\PageController@status');
        Route::resource('/menus', 'Admin\HeaderMenuController');
        Route::post('/menus/status/{id}', 'Admin\HeaderMenuController@status');
        Route::resource('/videos', 'Admin\VideosController');
        Route::post('/videos/status/{id}', 'Admin\VideosController@status');
        Route::resource('/photos', 'Admin\PhotoController');
        Route::post('/photos/status/{id}', 'Admin\PhotoController@status');
        Route::post('/photos/slide/status/{id}', 'Admin\PhotoController@changeSlideStatus');
        Route::resource('/clients', 'Admin\ClientController');
        Route::post('/clients/status/{id}', 'Admin\ClientController@status');
        Route::resource('/identities', 'Admin\IdentityController');
        Route::post('/identities/status/{id}', 'Admin\IdentityController@status');
        Route::get('/user/message', 'Admin\UserMessageController@index');
    });
    
    
});