<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
Route::namespace('App\Http\Controllers\Auth')->group(function () {
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('dashboard/login', 'LoginController@showLoginForm')->name('login');
    Route::post('dashboard/login', 'LoginController@login')->name('login');
    Route::get('dashboard/logout', 'LoginController@logout')->name('logout');
});
});


Route::group(['middleware' => ['auth']], function () {
Route::namespace('App\Http\Controllers\Dashboard')->group(function () {
Route::get('/dashboard', 'DashboardController@index')->name('admin');
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
Route::get('/error-page', 'DashboardController@error_page')->name('error-page');


Route::get('categories/{id}/delete','CategoryController@delete_item')->name('delete-category');
Route::resource('categories', 'CategoryController');
Route::get('categories/change_status/{id}', 'CategoryController@change_status')->name('categories.change_status');


Route::get('services/{id}/delete','ServiceController@delete_item')->name('delete-service');
Route::resource('services', 'ServiceController');
Route::get('services/change_status/{id}', 'ServiceController@change_status')->name('services.change_status');

Route::get('sub-services/{id}/delete','SubServiceController@delete_item')->name('delete-sub-service');
Route::resource('sub-services', 'SubServiceController');
Route::get('sub-services/change_status/{id}', 'SubServiceController@change_status')->name('sub-services.change_status');

Route::get('clients/{id}/delete','ClientController@delete_item')->name('delete-client');
Route::resource('clients', 'ClientController');
Route::get('clients/change_status/{id}', 'ClientController@change_status')->name('clients.change_status');

Route::resource('about-us', 'AboutUsController');

Route::resource('settings', 'SettingsController');

Route::get('contact-us/{id}/delete','ContactUsController@delete_item')->name('delete-contact-us');
Route::resource('contact-us', 'ContactUsController');

Route::resource('projects', 'ProjectController');
Route::get('projects/change_status/{id}', 'ProjectController@change_status')->name('projects.change_status');
Route::get('projects/{id}/delete','ProjectController@delete_item')->name('delete-project');
Route::get('projects/delete-image/{id}', 'ProjectController@delete_image')->name('projects.delete_image');
    

Route::resource('status', 'PropertyController');
Route::get('status/change_status/{id}', 'PropertyController@change_status')->name('status.change_status');
Route::get('status/{id}/delete','PropertyController@delete_item')->name('delete-status');

Route::resource('scopes', 'PropertyController');
Route::get('scopes/change_status/{id}', 'PropertyController@change_status')->name('scopes.change_status');
Route::get('scopes/{id}/delete','PropertyController@delete_item')->name('delete-scopes');

Route::resource('years', 'PropertyController');
Route::get('years/change_status/{id}', 'PropertyController@change_status')->name('years.change_status');
Route::get('years/{id}/delete','PropertyController@delete_item')->name('delete-years');

Route::resource('scales', 'PropertyController');
Route::get('scales/change_status/{id}', 'PropertyController@change_status')->name('scales.change_status');
Route::get('scales/{id}/delete','PropertyController@delete_item')->name('delete-scales');


Route::resource('careers', 'CareerController');
Route::get('careers/change_status/{id}', 'CareerController@change_status')->name('careers.change_status');
Route::get('careers/{id}/delete','CareerController@delete_item')->name('delete-career');


Route::resource('teams', 'TeamController');
Route::get('teams/change_status/{id}', 'TeamController@change_status')->name('teams.change_status');
Route::get('teams/{id}/delete','TeamController@delete_item')->name('delete-team');

Route::resource('news', 'NewsController');
Route::get('news/change_status/{id}', 'NewsController@change_status')->name('news.change_status');
Route::get('news/{id}/delete','NewsController@delete_item')->name('delete-news');


Route::resource('admins', 'AdminController');
Route::get('admins/change_status/{id}', 'AdminController@change_status')->name('admins.change_status');
Route::get('admins/{id}/delete','AdminController@delete_item')->name('delete-admin');
});
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    return 'Application cache has been cleared';
});

});
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
