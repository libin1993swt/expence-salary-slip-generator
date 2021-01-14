<?php

Route::get('/', function () {
    return redirect('admin');
});



Route::resource('admin/users', 'Admin\UsersController');
Route::resource('admin/expense', 'Admin\ExpenseController');
Route::resource('admin/groups', 'Admin\GroupsController');
Route::resource('admin/companies', 'Admin\CompanyController');
Route::resource('admin/employees', 'Admin\EmployeeController');
Route::resource('admin/slip/items','Admin\SlipItemController');
Route::resource('admin/slips','Admin\SlipController');

Route::post('admin/slips/generate-pdf','Admin\SlipController@generatePdf');

Route::get('admin/reports/users',[ 'uses' => 'Admin\Reports\UserReportController@index', 'as' => 'admin.reports.search']);
Route::get('admin/reports/pdf',[ 'uses' => 'Admin\Reports\UserReportController@generateReportPDF','as' => 'admin.reports.pdf']);

Route::get('data-scraping', 'DataScrapingController@index');

Route::get('/admin/{demopage?}', 'DemoController@demo')->name('demo');

Route::get('test/html','DemoController@html');

Route::get('vue/articles','VueController@index');