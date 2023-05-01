<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterConfirmationEmail;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;

class RegistrarController extends Controller
{

    public function index()
    { 
        if (Auth::check()) {
            return redirect()->intended('dashboard');
        }
        return view('auth.registrarse');
    }
    

    public function validation(Request $request)
    {
        
        // Definir la regla de validación personalizada para comparar contraseñas
        Validator::extend('compare_passwords', function ($attribute, $value, $parameters, $validator) {
            return $value == $validator->getData()[$parameters[0]];
        });

        Validator::extend('validate_email', function ($attribute, $value, $parameters, $validator) {
            
            try {
                $client = new Client();
                $response = $client->request('POST', env('BACKEND_SERVER').'verifyEmail', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        "Authorization" => env('ACCESS_TOKEN')
                    ],
                    'body' => json_encode(['email' => $value])
                ]);
    
                return true;
            } catch(ClientException $e) {
                $response = $e->getResponse();
                $status_code = $response->getStatusCode();
                if ($status_code == 409) {
                    $error_message = json_decode($response->getBody(), true)['message'];
                    return false;
                } else if ($status_code == 500){
                    return true;
                }
            }
        });

        // Definir las reglas de validación para el formulario
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|max:255',
            'email' => 'required|validate_email|email|max:255',
            'password' => 'required|min:8',
            'passwordV' => 'required|compare_passwords:password'
        ], [
            'fullname.required' => 'El campo es obligatorio',
            'email.required' => 'El campo el obligatorio',
            'email.email' => 'Formato de correo no válido',
            'password.required' => 'El campo es obligatorio',
            'password.min' => 'Debe introducir al menos 8 caracteres',
            'passwordV.required' => 'El campo es obligatorio',
            'passwordV.compare_passwords' => 'Las contraseñas no coinciden',
            'email.validate_email' => 'El correo electrónico ya está asociado a una cuenta'
        ]);

        if ($validator->fails()) {
            return redirect('registrarse')
                ->withErrors($validator)
                ->withInput();
        } else {
            $client = new Client();
            $name = $request->input('fullname');
            $email = $request->input('email');
            $password = $request->input('password');
            $confirmation_code = Str::random(30);
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password
            ];
            try {
                $response = $client->request('POST', env('BACKEND_SERVER').'register', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        "Authorization" => env('ACCESS_TOKEN')
                    ],
                    'body' => json_encode($data)
                ]);
                
                $user_data = json_decode($response->getBody(), true);
                $response = $client->request('POST', env('BACKEND_SERVER').'createConfirmation', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        "Authorization" => env('ACCESS_TOKEN')
                    ],
                    'body' => json_encode([
                        'userId' => $user_data['id'],
                        'code' => $confirmation_code
                    ])
                ]);
                $user_confirm = [
                    'name' => $user_data['name'],
                    'email' => $user_data['email'],
                    'confirmation_code' => $confirmation_code
                ];
                Mail::to($user_data['email'])->send(new RegisterConfirmationEmail($user_confirm));
                return view('validation')
                    ->with('title', 'Gracias por registrarse')
                    ->with('success', 'Verifique su correo electrónico para la confirmacion de su correo');
            } catch(ClientException $e) {
                $response = $e->getResponse();
                $status_code = $response->getStatusCode();
                $error_message = json_decode($response->getBody(), true)['message'];
                return redirect('registrarse')->with("email_error", $error_message)
                    ->withInput();
            }
            
            
        }
    }
}
