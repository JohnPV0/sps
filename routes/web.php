<?php

use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\VideoController;

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

Route::get('/', function () {
    return view('home');
});


Route::get('login', [AuthController::class, 'index'])->name('login');

Route::post('login/submit', [AuthController::class, 'login'])->name('login.submit');

Route::get('error', function () {
    return view('error');
})->name('error');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/descargar', function () {
    return view('descargar');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'perfil'])->name('dashboard');
    Route::get('perfil', [UserController::class, 'index'])->name('perfil');
    
    Route::post('pay', [PaymentController::class, 'pay'])->name('payment');
    Route::get('/payment/success', [PaymentController::class, 'success']);
    Route::get('/payment/error', [PaymentController::class, 'error']);
    Route::get('/actualizar', [UserController::class, 'updateView'])->name('actualizar');
    Route::post('/actualizar', [UserController::class, 'update'])->name('actualizar.submit');
    Route::get('/suscripciones', [UserController::class, 'suscripciones'])->name('suscripciones');
    Route::get('/aprender', [VideoController::class, 'index'])->name('aprender');
});

Route::get('/registrarse', [RegistrarController::class, 'index'])->name('register');

Route::get('compras', [ComprasController::class, 'index'])->name('compras');


Route::get('/registrarse/confirm/{code}/{email}', function ($code, $email) {
    $client = new Client();
    try {
        $response = $client->request('POST', env('BACKEND_SERVER').'confirmAccount', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => env('ACCESS_TOKEN')
            ],
            'body' => json_encode([
                'email' => $email,
                'code' => $code])
        ]);

        return view('validation')
                    ->with('title', 'Bienvenido')
                    ->with('success', 'Correo verificado');
    } catch(ClientException $e) {
        $response = $e->getResponse();
        $status_code = $response->getStatusCode();
        $error_message = json_decode($response->getBody(), true)['message'];
        if ($status_code == 409) {
            return view('validation')
                    ->with('title', 'Error')
                    ->with('error', 'El correo ya ha sido verificado');
        } 
        return view('validation')
                    ->with('title', 'Error')
                    ->with('error', $error_message);
    }
});

Route::post('/registrarse/send', [RegistrarController::class, 'validation'])->name('send.submit');



