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
  CURLOPT_URL => env('ZENITHBANKURL').'&amount='.$amount.'&desc=payment&referenceID='.$referenceID.'&productID='.$productID.'&customerID=11230&merchantlogo=123&merchantName=Cedipay',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
return $response;



    }


    static public function pay12($amount, $referenceID, $productID, $customerID)
    {

     

      $curl = curl_init();
      
      curl_setopt_array($curl, array(
        CURLOPT_URL => env('ZENITHBANKURL').'&amount='.$amount.'&desc=product&referenceID='.$referenceID.'&productID='.$productID.'&customerID='.$customerID.'&merchantlogo=123&merchantName=HisenseGH&API-KEY='.env("Z_KEY").'',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
      ));
      
      $response = curl_exec($curl);
      
      curl_close($curl);
      return $response;
      




$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => env('ZENITHBANKURL_TEST').'&API-KEY="641923e50cf549579ea6ad07355047e2​"&amount='.$amount.'&desc=payment&referenceID='.$referenceID.'&productID='.$productID.'&customerID=11230&merchantlogo=123&merchantName=Cedipay',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
dd($response);
return $response;



    }


    static public function redirectPay($tID)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env("ZENITH_REDIRECT_URL_TEST").'&tid='.$tID.'',
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
  CURLOPT_URL => 'https://www.globalpay.com.gh/paymentapiV2/Service/confirmTransaction?gpid=GPZEN098&Ref='.$ref.'',
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
