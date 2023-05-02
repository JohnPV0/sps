<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;

class ComprasController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('compras')->with('suscription', false);
        }
        $client = new Client();
        try {
            $reponse = $client->request('POST', env('BACKEND_SERVER').'getSubscription', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    "Authorization" => env('ACCESS_TOKEN')
                ],
                'body' => json_encode([
                    'id_user' => Auth::id(),
                ])
            ]);
            $suscription = json_decode($reponse->getBody(), true);
            if (!$suscription) {
                return view('compras')->with('suscription', false);
            }
            $fechaHoraDesdeDB = $suscription['end_date'];
            $fechaHoraCarbon = Carbon::parse($fechaHoraDesdeDB);
            if ($suscription['active'] == 1) {
                // la fecha/hora de la base de datos es mayor que $otraFechaHora
                return view('compras')->with('suscription', $suscription)->with('end_date', $fechaHoraCarbon);
            }
            return view('compras')->with('suscription', false);
        } catch(ClientException $e) {
            $response = $e->getResponse();
            $status_code = $response->getStatusCode();
            if($status_code == 404) {
                return view('compras')->with('suscription', false);
            }
           
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $status_code = $response->getStatusCode();

            return redirect('error');
        }
    }
}
