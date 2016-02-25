<?php



//Route::group(['prefix' => 'api/v1'], function(){

//	Route::get('auth/socialite/{provider}', 'Api\SocialAccountController@redirect');
//	Route::get('auth/callback/{provider}', 'Api\SocialAccountController@callback');
//	Route::get('register', 'Api\SocialAccountController@register');
   // Route::get('auth/callback/{provider}', 'Api\SocialAccountController@callbackLogin');
//});

Route::group(['prefix' => 'api/v1'], function () {

    Route::get('parking/location', 'Api\LocationController@index');

    Route::get('parking/location/show/{location}','Api\LocationController@showLocation');

    Route::get('parking/user/', 'Api\UserController@index');
    	
});

Route::group(['prefix' => 'api'], function() {

    Route::post('login/user', 'Api\AuthController@login');
    Route::post('register/user', 'Api\AuthController@register');
    Route::get('get/user', 'Api\AuthController@getAuthenticatedUser');

    Route::group(['middleware' => ['jwt.auth', 'jwt.refresh']], function() {

        Route::post('logout', 'Api\AuthController@logout');

        Route::get('test', function(){
            return response()->json(['foo'=>'bar']);
        });
    });
});

//Route::get('api/v1', ['middleware' => 'auth', function() {
    
//}]);

//Route::get('test', function(){
 //    App\User::create(['email' => 'admin@admin.com', 'password' => bcrypt('admin')]);

//});

//Route::post('coba', 'Api\LocationController@createLocation');
//Route::get('redirectlogin/{provider}', 'Api\SocialAccountController@redirectLogin');
