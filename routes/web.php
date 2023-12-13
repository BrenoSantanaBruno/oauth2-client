<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('prepare-to-login', function () {
   $state = Str::random(40);
    $query = http_build_query([
         'client_id' => env('CLIENT_ID'),
         'redirect_uri' => env('REDIRECT_URL'),
         'response_type' => 'code',
         'scope' => '',
         'state' => $state,
    ]);
    return redirect('http://localhost:8000/oauth/authorize?'.$query);
})->name('prepare-to-login');

Route::get('callback', function (Request $request) {
//    $http = new GuzzleHttp\Client;
//    $response = $http->post('http://localhost:8000/oauth/token', [
//         'form_params' => [
//             'grant_type' => 'authorization_code',
//             'client_id' => 3,')
    dd($request->all());
});
