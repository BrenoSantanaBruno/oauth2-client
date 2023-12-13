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

    session([
         'state' => $state
    ]);

    $query = http_build_query([
         'client_id' => env('CLIENT_ID'),
         'redirect_uri' => env('REDIRECT_URL'),
         'response_type' => 'code',
         'scope' => '',
         'state' => $state,
    ]);
    return redirect('http://localhost:8000/oauth/authorize?'.$query);
})->name('prepare.login');

Route::get('callback', function () {
    $request = request(); // Use a função helper 'request()' para obter a instância da requisição atual
//    dd($request->all());

    // Verificacao do state
    $response = Http::post(env('API_URL').'/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => env('CLIENT_ID'),
        'client_secret' => env('CLIENT_SECRET'),
        'redirect_uri' => env('REDIRECT_URL'),
        'code' => $request->code,
    ]);
    dd($response->json());
});

Route::get('grant-client', function () {
    $response = Http::post(env('API_URL').'/oauth/token', [
        'grant_type' => 'client_credentials',
        'client_id' => 4,
        'client_secret' => 'DaxIwrwLoPStjcK3gdQ6uFFk3dHXOG6yBueONQzH',
        'scope' => '',
    ]);
    dd($response->json());
});
