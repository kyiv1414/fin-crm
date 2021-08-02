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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('employee/{id}', 'EmployeeController@show');

Route::get('employee/salary/{employee_id}', 'EmployeeController@getCurrentMonthSalary');

Route::get('expenses', 'FinanceReportController@getExpenses');

Route::get('incomes', 'FinanceReportController@getIncomes');

Route::get('profits', 'FinanceReportController@getProfits');
