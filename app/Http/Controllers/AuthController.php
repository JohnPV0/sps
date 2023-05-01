<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as RequestAuth;


class AuthController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            return redirect()->intended('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {

        if(Auth::check()) {
            return redirect()->intended('dashboard');
        }

        $credentials = $request->only('email', 'password');

        $url = env('BACKEND_SERVER') . 'auth/login';
        $client = new Client();
        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    "Authorization" => env('ACCESS_TOKEN')
                ],
                'body' => json_encode($credentials)
            ]);
            
            $user_data = json_decode($response->getBody(), true);
            Auth::loginUsingId($user_data['id']);

            $response = $client->request('POST', env('BACKEND_SERVER').'sessionWeb', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    "Authorization" => env('ACCESS_TOKEN')
                ],
                'body' => json_encode([
                    'userId' => $user_data['id'],
                    'cookie' => RequestAuth::cookie('laravel_session')
                ])
            ]);
            
            return redirect()->intended('dashboard');
        } catch(ClientException $e) {
            $response = $e->getResponse();
            $status_code = $response->getStatusCode();
            $error_message = json_decode($response->getBody(), true)['message'];
            return redirect('login')->with("email_error", $error_message)
                ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function perfil() {
        $url = env('BACKEND_SERVER').'getDataUser';
        $client = new Client();
        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                "Authorization" => env('ACCESS_TOKEN')
            ],
            'body' => json_encode([
                'id_user' => Auth::id()
            ])
        ]);
        $user = json_decode($response->getBody(), true);
        return view('dashboard')->with('user', $user);
    }
}
