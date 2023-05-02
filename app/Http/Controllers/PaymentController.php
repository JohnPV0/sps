<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct() {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(boolval(env('PAYPAL_SANDBOX_MODE')));
    }

    public function pay(Request $request) {
        try {
            $response = $this->gateway->purchase([
                'amount' => 6.99,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('/payment/success'),
                'cancelUrl' => url('/payment/error')
            ])->send();

            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            } 
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request) {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $response = $this->gateway->completePurchase([
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ])->send();

            if ($response->isSuccessful()) {
                $data = $response->getData();
                $payment_method = 1;
                $payer_id = $data['payer']['payer_info']['payer_id'];
                $payer_email = $data['payer']['payer_info']['email'];
                $payment_id = $data['id'];
                $amount = $data['transactions'][0]['amount']['total'];
                $payment_status = $data['state'];
                $currency = env('PAYPAL_CURRENCY');
                $id_user = Auth::id();
                try {
                    $datos = [
                        'id_payment_method' => $payment_method,
                        'payer_id' => $payer_id,
                        'payer_email' => $payer_email,
                        'payment_id' => $payment_id,
                        'amount' => $amount,
                        'payment_status' => $payment_status,
                        'currency' => $currency,
                        'id_user' => $id_user
                    ];

                    $client = new Client();
                    $responsePayment = $client->request('POST', env('BACKEND_SERVER').'payment', [
                        'headers' => [
                            'Content-Type' => 'application/json',
                            "Authorization" => env('ACCESS_TOKEN')
                        ],
                        'body' => json_encode($datos)
                    ]);

                    

                    $client = new Client();
                    $responseSubs = $client->request('POST', env('BACKEND_SERVER').'subscription',[
                        'headers' => [
                            'Content-Type' => 'application/json',
                            "Authorization" => env('ACCESS_TOKEN')
                        ],
                        'body' => json_encode([
                            'id_user' => $id_user,
                            'id_payment' => json_decode($responsePayment->getBody(), true)['id']
                        ])
                    ]);
                    
                } catch (ClienException $e) {
                    $response = $e->getResponse();
                    $status_code = $response->getStatusCode();
                    $response = json_decode($response->getBody(), true);
                    

                    return $response['message'];
                } catch (RequestException $e) {
                    $response = $e->getResponse();
                    $status_code = $response->getStatusCode();
        
                    return redirect('error');
                }
                return view('payments.success')->with('payment_id', $data['id']);
            } else {
                return $response->getMessage();
            }
        } else {
            return 'La transaccion no se pudo completar';
        }
    }

    public function error(Request $request) {
        return view('payments.error');
    }
}
