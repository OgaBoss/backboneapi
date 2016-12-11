<?php

use Illuminate\Http\Request;

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
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE, PATCH');
header("Access-Control-Allow-Headers: Authorization, X-Requested-With,  Content-Type, Accept");

$api = app('Dingo\Api\Routing\Router');

$api->version(['v1', 'middleware' => 'api|cors'], function($api){
    $api->post('authenticate', [
        'as' => 'authenticate.user',
        'uses' => 'App\Http\Controllers\Api\LoginController@authenticate'
    ]);

    $api->get('currentAuthUser',[
        'as' => 'currentAuthUser',
        'uses' => 'App\Http\Controllers\Api\LoginController@getAuthenticatedUser'
    ]);

    $api->get('enrollee/getChildren/{id}', [
        'as' => 'getChildren',
        'uses' => 'App\Http\Controllers\Api\EnrolleeController@getChildren'
    ]);

    $api->get('state', [
        'as' => 'state',
        'uses' => 'App\Http\Controllers\Api\PlacesController@getState'
    ]);

    $api->get('lg',[
        'as' => 'lg',
        'uses' => 'App\Http\Controllers\Api\PlacesController@getLgs'
    ]);

    $api->post('uploadImage/{id}',[
        'as' => 'uploadImage',
        'uses' => 'App\Http\Controllers\Api\EnrolleeController@storeEnrolleeImage'
    ]);

    $api->post('parseFile',[
        'as' => 'parseFile',
        'uses' => 'App\Http\Controllers\Api\FileParseController@store'
    ]);

    $api->get('enrollee/search/{email}',[
        'as' => 'search',
        'uses' => 'App\Http\Controllers\Api\EnrolleeController@search'
    ]);

    $api->get('ailment/search/{text}',[
        'as' => 'search',
        'uses' => 'App\Http\Controllers\Api\AilmentController@search'
    ]);

    $api->get('organizations/{id}/others',[
        'as' => 'others',
        'uses' => 'App\Http\Controllers\Api\OrganizationPlanController@others'
    ]);

    $api->post('mailParams',[
        'as' => 'mail.params',
        'uses' => 'App\Http\Controllers\EmailController@mailParams'
    ]);

    $api->get('codes/{code}/search',[
        'as' => 'code.search',
        'uses' => 'App\Http\Controllers\Api\ReferralCodeController@search'
    ]);




    $api->resource('enrollees','App\Http\Controllers\Api\EnrolleeController');
    $api->resource('organizations','App\Http\Controllers\Api\OrganizationController');
    $api->resource('plans','App\Http\Controllers\Api\PlanController');
    $api->resource('hospitals','App\Http\Controllers\Api\HospitalController');
    $api->resource('pharmacies','App\Http\Controllers\Api\PharmacyController');
    $api->resource('ailments','App\Http\Controllers\Api\AilmentController');
//    $api->resource('medical-records','App\Http\Controllers\Api\MedicalRecordController');
    $api->resource('nhis','App\Http\Controllers\Api\NhisController');
    $api->resource('nhisTracker','App\Http\Controllers\Api\NhisTrackerController');
    $api->resource('bands','App\Http\Controllers\Api\BandController');
    $api->resource('codes','App\Http\Controllers\Api\ReferralCodeController');

    $api->resource('organizations.enrollees','App\Http\Controllers\Api\OrganizationEnrolleeController');
    $api->resource('organizations.plans','App\Http\Controllers\Api\OrganizationPlanController');
    $api->resource('hmo.hospital','App\Http\Controllers\Api\HmoHospitalController');
//    $api->resource('enrollee.record','App\Http\Controllers\Api\EnrolleeRecordsController');
    $api->resource('enrollee.claims','App\Http\Controllers\Api\EnrolleeClaimsInfoController');
    $api->resource('enrollee.healths','App\Http\Controllers\Api\EnrolleeHealthInfoController');
    $api->resource('hospital.claims','App\Http\Controllers\Api\HospitalClaimsController');
});

