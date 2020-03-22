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

Route::post('login', 'AuthController@login');
Route::get('/testimonials', 'TestimonialsController@indexActive');
Route::get('/featured-properties', 'FeaturedPropertiesController@indexActive');
Route::get('/properties', 'PropertiesController@indexActive');
Route::get('/properties/types', 'PropertiesController@getTypes');
Route::get('/properties/statuses', 'PropertiesController@getStatuses');
Route::get('/properties/prices', 'PropertiesController@getPrices');
Route::post('/properties/search', 'PropertiesController@search');
Route::post('/mail/offer-property', 'MailController@offerProperty');
Route::post('/mail/book-a-viewing', 'MailController@bookAViewing');
Route::post('/mail/inquire-properties', 'MailController@inquireProperties');

Route::group(['middleware' => 'auth:api'], function() {
  Route::get('user', 'AuthController@user');

  Route::group(['prefix' => 'admin'], function() {
    Route::group(['prefix' => 'properties'], function() {
      Route::get('/', 'PropertiesController@index');
      Route::get('/not-sold', 'PropertiesController@indexNotSold');
      Route::post('/', 'PropertiesController@store');
      Route::put('/{property}', 'PropertiesController@update');
      Route::get('/{property}', 'PropertiesController@show');
      Route::delete('/{property}', 'PropertiesController@destroy');
    });
    Route::group(['prefix' => 'testimonials'], function() {
      Route::get('/', 'TestimonialsController@index');
      Route::post('/', 'TestimonialsController@store');
      Route::put('/{testimonial}', 'TestimonialsController@update');
      Route::get('/{testimonial}', 'TestimonialsController@show');
      Route::delete('/{testimonial}', 'TestimonialsController@destroy');
    });
    Route::group(['prefix' => 'featured-properties'], function() {
      Route::get('/', 'FeaturedPropertiesController@index');
      Route::post('/', 'FeaturedPropertiesController@store');
      // Route::get('/{property}', 'FeaturedPropertiesController@show');
      Route::post('/{property}', 'FeaturedPropertiesController@destroy');
    });
  });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//   return $request->user();
// });


