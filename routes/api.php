<?php

Route::group([ 'prefix' => 'token' ], function () {
	Route::post('auth-attempt', 'AuthController@tokenAuthAttempt');
	Route::post('auth-once', 'AuthController@tokenAuthOnce');
	Route::post('auth-login-using-id', 'AuthController@tokenAuthLoginUsingId');
	Route::post('auth-validate', 'AuthController@tokenAuthValidate');

	Route::group([ 'middleware' => 'auth:token' ], function () {
		Route::post('auth-check', 'AuthController@tokenAuthCheck');
		Route::post('auth-user', 'AuthController@tokenAuthUser');
		Route::post('auth-id', 'AuthController@tokenAuthId');
		Route::post('auth-login', 'AuthController@tokenAuthLogin');
		Route::post('auth-logout', 'AuthController@tokenAuthLogout');
	});
});

Route::group([ 'prefix' => 'api' ], function () {
	Route::post('auth-attempt', 'AuthController@apiAuthAttempt');
	Route::post('auth-once', 'AuthController@apiAuthOnce');
	Route::post('auth-login-using-id', 'AuthController@apiAuthLoginUsingId');
	Route::post('auth-validate', 'AuthController@apiAuthValidate');

	Route::group([ 'middleware' => 'auth:api' ], function () {
		Route::post('auth-check', 'AuthController@apiAuthCheck');
		Route::post('auth-user', 'AuthController@apiAuthUser');
		Route::post('auth-id', 'AuthController@apiAuthId');
		Route::post('auth-login', 'AuthController@apiAuthLogin');
		Route::post('auth-logout', 'AuthController@apiAuthLogout');
	});
});