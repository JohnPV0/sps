<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function update(Request $request) 
    {
        // Definir la regla de validación personalizada para comparar contraseñas
        Validator::extend('compare_passwords', function ($attribute, $value, $parameters, $validator) {
            return $value == $validator->getData()[$parameters[0]];
        });
        // Definir las reglas de validación para el formulario
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
            'passwordV' => 'required|compare_passwords:password'
        ], [
            'password.required' => 'El campo es obligatorio',
            'password.min' => 'Debe introducir al menos 8 caracteres',
            'passwordV.required' => 'El campo es obligatorio',
            'passwordV.compare_passwords' => 'Las contraseñas no coinciden',
        ]);

        if ($validator->fails()) {
            return redirect('actualizar')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $client = new Client();
            $id_user = Auth::id();
            $password = $request->input('password');
            $data = [
                'id_user' => $id_user,
                'password' => $password
            ];
            try {
                $response = $client->request('PATCH', env('BACKEND_SERVER').'user', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        "Authorization" => env('ACCESS_TOKEN')
                    ],
                    'body' => json_encode($data)
                ]);
                return view('actualizar')
                    ->with('success', 'Contraseña actualizada correctamente');
            } catch(ClientException $e) {
                $response = $e->getResponse();
                $status_code = $response->getStatusCode();
                $error_message = json_decode($response->getBody(), true)['message'];
                return redirect('actualizar')
                    ->withErrors($error_message)
                    ->withInput();
            }
        }
    }

    public function updateView() {
        return view('actualizar');
    }

    public function suscripciones() {
        $client = new Client();
        $id_user = Auth::id();
        $data = [
            'id_user' => $id_user
        ];
        try {
            $response = $client->request('GET', env('BACKEND_SERVER').'subscription/'.$id_user, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    "Authorization" => env('ACCESS_TOKEN')
                ],
                'body' => json_encode($data)
            ]);
            $suscripciones = json_decode($response->getBody(), true);
            return view('user.suscripciones')
                ->with('suscripciones', $suscripciones);
        } catch(ClientException $e) {
            $response = $e->getResponse();
            $status_code = $response->getStatusCode();
            if($status_code == 404) {
                return view('user.suscripciones')->with('suscripciones', false);
            }
        }
    }
}
