<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('officeList', 'API\RegisterApiController@getOffice');
Route::get('/head/office', 'API\RegisterApiController@getHeadOffice');
Route::get('status', 'API\RegisterApiController@getStatus');
Route::get('designationList', 'API\RegisterApiController@getDesignation');
Route::post('register', 'API\RegisterApiController@register');
Route::post('/user/update/{id}', 'API\RegisterApiController@updateUser');
Route::post('authenticate', 'API\LoginApiController@authenticate');
Route::post('/change/password', 'API\RegisterApiController@changePassword');
Route::post('sales/person/store', 'API\DailySalesReportController@storeSalesPersonDetail');
Route::post('salesarea/store', 'API\DailySalesReportController@storeSalesAreaDetailWithResponse');

Route::post('client/store', 'API\DailySalesReportController@storeClientDetail');
Route::post('client/update/{id}', 'API\DailySalesReportController@updateClientDetail');
Route::get('sales/clients/{id}', 'API\DailySalesReportController@getClientsData');
Route::get('sales/followupclients/{id}', 'API\DailySalesReportController@getFollowupClientsData');
Route::get('sales/missed/followupclients/{id}', 'API\DailySalesReportController@getMissedFollowupClientsData');

Route::get('/user/sales/persons/{id}/{pageSize}', 'API\DailySalesReportController@getLatestSalesPersonDetail');
Route::get('sales/person/{id}', 'API\DailySalesReportController@getSalesPersonDetail');

Route::get('client/{id}', 'API\DailySalesReportController@getClientDetail');
Route::get('noticeList', 'API\NoticeApiController@getNoticeList');
Route::get('noticeDetails/{id}', 'API\NoticeApiController@getNoticeDetails');
Route::get('/office/sale/report','API\ReportController@officeWiseSaleProduct');
Route::get('/user/performance/report/{id}','API\SalesReportController@index');
Route::get('/user/leaves/{id}','API\LeaveController@getCurrentMonthLeaves');
Route::post('/user/leaves/store','API\LeaveController@storeLeave');
