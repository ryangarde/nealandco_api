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
Route::get('/properties', 'PropertiesController@indexNotSold');
Route::get('/properties/types', 'PropertiesController@getTypes');
Route::get('/properties/statuses', 'PropertiesController@getStatuses');
Route::get('/properties/prices', 'PropertiesController@getPrices');
Route::post('/properties/search', 'PropertiesController@search');
Route::get('/properties/{property}', 'PropertiesController@show');
Route::get('/properties/{property}/images', 'PropertyImagesController@index');
Route::post('/mail/offer-property', 'MailController@offerProperty');
Route::post('/mail/book-a-viewing', 'MailController@bookAViewing');
Route::post('/mail/inquire-properties', 'MailController@inquireProperties');

Route::group(['middleware' => 'auth:api'], function() {
  Route::get('user', 'AuthController@user');

  Route::group(['prefix' => 'admin'], function() {
    Route::group(['prefix' => 'properties'], function() {
      Route::delete('/{property}/images/{propertyImage}', 'PropertyImagesController@destroy');
      Route::post('/{property}/images', 'PropertyImagesController@store');
      Route::get('/{property}/images', 'PropertyImagesController@index');
      Route::get('/not-sold', 'PropertiesController@indexNotSoldNoPaginate');
      Route::get('/{property}', 'PropertiesController@show');
      Route::post('/{property}', 'PropertiesController@propertySold');
      Route::put('/{property}', 'PropertiesController@update');
      Route::delete('/{property}', 'PropertiesController@destroy');
      Route::get('/', 'PropertiesController@index');
      Route::post('/', 'PropertiesController@store');
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


