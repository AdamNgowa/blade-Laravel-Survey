<?php

namespace App\services;

use Illuminate\Support\Facades\Http;

class PayPalService 
{
    protected $baseurl;

    public function __construct()
    {
        $this->baseurl = config('services.paypal.base_url');

    }

    public function getAccessToken(){
        $response = Http::withBasicAuth(
            config('services.paypal.client_id'),
            config('services.paypal.client_secret')
        )
        ->asForm()
        ->post($this->baseurl.'v1/oauth2/token',[
            'grant_type' => 'client_credentials'
        ]);


    }

    public function createOrder($amount){
        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->post($this->baseurl.'v2/checkout/orders',[
                'intent' => 'CAPTURE',

                'purchase_units' => [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => number_format($amount,2,'.','')
                    ]
                ],
                'application_context'=> [
                    'return_url' => route('paypal.success'),
                    'cancel_url' => route('paypal.cancel')
                ]
            ]);

            return $response->json();
    }

    public function capturePayment($orderId){
        
        $token = $this->getAccessToken();

        $response  = Http::withToken($token)
            ->post($this->baseurl."/v2/checkout/orders/{$orderId}/capture");

        return $response->json();    
    }


}

