<?php

use App\Models\Company;
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
// route user
Route::post('register', '\App\Http\Controllers\Api\UserController@register');
Route::post('login', '\App\Http\Controllers\Api\UserController@login');
Route::post('loginsend', '\App\Http\Controllers\Api\UserController@sendLoginLink');
Route::post('checklogin', '\App\Http\Controllers\Api\UserController@checklogin');
Route::post('logout', '\App\Http\Controllers\Api\UserController@logout');

// validate user
Route::get('validateuser/index', '\App\Http\Controllers\ValidateUserController@index');

//test
Route::post('validateuser/register', '\App\Http\Controllers\ValidateUserController@register');


Route::post('validate', '\App\Http\Controllers\ValidateUserController@validateuser'); // a tester
Route::post('destroy', '\App\Http\Controllers\ValidateUserController@destroy');
//route user auth
Route::get('profilusers/index/{apiToken}', '\App\Http\Controllers\ProfilUserController@index'); // a tester

// route validate company
Route::post('validatecompanies/update', '\App\Http\Controllers\ValidateCompanyController@update'); // a  tester
Route::post('validatecompanies/store', '\App\Http\Controllers\ValidateCompanyController@store');
Route::get('validatecompanies/index', '\App\Http\Controllers\ValidateCompanyController@index');
Route::post('validatecompanies/validate', '\App\Http\Controllers\ValidateCompanyController@validatecompany'); // a  tester
Route::post('validatecompanies/destroy', '\App\Http\Controllers\ValidateCompanyController@destroy');

// route company
Route::post('companies/update', '\App\Http\Controllers\CompanyController@update');
Route::post('companies/store', '\App\Http\Controllers\CompanyController@store');
Route::get('companies/index', '\App\Http\Controllers\CompanyController@index');


// route admin dashboard
Route::get('admin/dashboard/companies', '\App\Http\Controllers\Api\UserController@dashboardcompanies')/* ->middleware('admin') */; // a  tester
Route::get('admin/dashboard/users', '\App\Http\Controllers\Api\UserController@dashboardusers')/* ->middleware('admin') */; // a  tester

//route admin excel

Route::post('admin/import', '\App\Http\Controllers\ExcelController@import'); // a tester
Route::get('admin/export', '\App\Http\Controllers\ExcelController@export'); // a tester
Route::get('admin/export/private', '\App\Http\Controllers\ExcelController@exportprivate'); // a tester
Route::get('admin/export/public', '\App\Http\Controllers\ExcelController@exportpublic'); // a tester
