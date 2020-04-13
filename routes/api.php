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
Route::get('/properties/{property}/amenities', 'AmenitiesController@index');
Route::post('/mail/offer-property', 'MailController@offerProperty');
Route::post('/mail/book-a-viewing', 'MailController@bookAViewing');
Route::post('/mail/inquire-properties', 'MailController@inquireProperties');
Route::get('/settings', 'SettingsController@show');

Route::group(['middleware' => 'auth:api'], function() {
  Route::get('user', 'AuthController@user');

  Route::group(['prefix' => 'admin'], function() {
    Route::group(['prefix' => 'properties'], function() {
      Route::delete('/{property}/images/{propertyImage}', 'PropertyImagesController@destroy');
      Route::post('/{property}/images', 'PropertyImagesController@store');
      Route::get('/{property}/images', 'PropertyImagesController@index');

      Route::post('/{property}/amenities', 'AmenitiesController@store');
      Route::delete('/{property}/amenities/{amenity}', 'AmenitiesController@destroy');

      Route::get('/not-sold', 'PropertiesController@indexNotSoldNoPaginate');

      Route::get('/sold', 'DashboardController@propertiesSold');
      Route::get('/leased', 'DashboardController@propertiesLeased');

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
      Route::get('/{testimonial}', 'TestimonialsController@show');
      Route::put('/{testimonial}', 'TestimonialsController@update');
      Route::post('/{testimonial}/image', 'TestimonialsController@updateImage');
      Route::delete('/{testimonial}', 'TestimonialsController@destroy');
    });

    Route::group(['prefix' => 'featured-properties'], function() {
      Route::get('/', 'FeaturedPropertiesController@index');
      Route::post('/', 'FeaturedPropertiesController@store');
      Route::patch('/{property}', 'FeaturedPropertiesController@storeOne');
      Route::post('/{property}', 'FeaturedPropertiesController@destroy');
    });

    Route::group(['prefix' => 'settings'], function() {
      Route::get('/', 'SettingsController@show');
      Route::post('/set-email-receiver', 'SettingsController@setEmailReceiver');
      Route::post('/set-facebook-link', 'SettingsController@setFacebookLink');
      Route::post('/set-youtube-link', 'SettingsController@setYoutubeLink');
      Route::post('/set-instagram-link', 'SettingsController@setInstagramLink');
      Route::post('/set-twitter-link', 'SettingsController@setTwitterLink');
      Route::post('/set-linkedin-link', 'SettingsController@setLinkedInLink');
    });
  });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//   return $request->user();
// });


