<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Tutaj można zarejestrować API dla aplikacji. 
| To jest ładowane przez plik RouteServiceProvider.
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
