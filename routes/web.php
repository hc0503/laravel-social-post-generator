<?php
  use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route url
Route::middleware(['auth'])->group(function () {
  Route::get('/', 'DashboardController@dashboardAnalytics');

  // Route Dashboards
  Route::get('/dashboard-analytics', 'DashboardController@dashboardAnalytics');
  Route::get('/scrap-image', 'ScrapImageController@index');
  Route::post('/scrap-image', 'ScrapImageController@getImages');
});


Auth::routes();

// locale Route
Route::get('lang/{locale}',[LanguageController::class,'swap']);
