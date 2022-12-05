<?php

namespace App\Services\Banks;

use Illuminate\Support\Facades\DB;


class Zenith
{


    static public function pay($amount, $referenceID, $productID, $customerID)
    {

// dd($amount, $referenceID, $productID, $customerID);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://aspd.zenithbank.com.gh/globalpayapiV2/Service/SecurePaymentRequest?GPID=GPZEN098&amount='.$amount.'&desc=Hisensegh%20now&referenceID='.$referenceID.'&productID='.$productID.'&customerID=112302&merchantlogo=12322&merchantName=Cedipay',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: .AspNetCore.Antiforgery.LG2h8eouDQU=CfDJ8B7Xcv9SsfNCgElcEp5d8PHHqEJVL3IYLiPUIiSUxISyalhs4LMJ4LwtCXw9K5MbNuhE0N83WcMk-aRabX81GQ35A8jFeOhIyE30VTVf17wRZimmOR9mWwEeiDeHqEu2E7hOxrdTXDfCLWXb0egRZHM'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;

    }


    static public function redirectPay($tID)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://aspd.zenithbank.com.gh/globalpayapiV2/Service/PaySecure?gpid=GPZEN098&tid='.$tID.'',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: .AspNetCore.Antiforgery.LG2h8eouDQU=CfDJ8B7Xcv9SsfNCgElcEp5d8PHHqEJVL3IYLiPUIiSUxISyalhs4LMJ4LwtCXw9K5MbNuhE0N83WcMk-aRabX81GQ35A8jFeOhIyE30VTVf17wRZimmOR9mWwEeiDeHqEu2E7hOxrdTXDfCLWXb0egRZHM'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }


    static public function getTransaction($ref)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://aspd.zenithbank.com.gh/globalpayapiV2/Service/PaySecure?gpid=GPZEN098&Ref=' . json_encode($ref) . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: .AspNetCore.Antiforgery.LG2h8eouDQU=CfDJ8B7Xcv9SsfNCgElcEp5d8PHHqEJVL3IYLiPUIiSUxISyalhs4LMJ4LwtCXw9K5MbNuhE0N83WcMk-aRabX81GQ35A8jFeOhIyE30VTVf17wRZimmOR9mWwEeiDeHqEu2E7hOxrdTXDfCLWXb0egRZHM'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
