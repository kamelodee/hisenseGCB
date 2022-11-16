<?php

namespace App\Services\Banks;

use Illuminate\Support\Facades\DB;


class Uba
{


  static public function pay($name, $phone, $amount, $order_code)
  {
    // return $phone;
    $name = explode(" ", $name);
    $string = 'kamelodee@gmail.com' . $name[0] . $name[1] . 'GH1400134' . $order_code . $amount . '';
    $hash = hash_hmac('sha512', $string, 'ef1b90404c24dab68acd39e0ce51f1112c9fc760');


    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://gh.instantbillspay.com/instantpay/payload/bill/payment',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{
      "email":"kamelodee@gmail.com",
      "firstname":' . json_encode($name[0]) . ',
      "lastname":' . json_encode($name[1]) . ',
      "phone": ' . json_encode($phone) . ',
      "merchantID" : "GH1400134",
      "uniqueID": ' . json_encode($order_code) . ',
      "description": " test pay",
      "amount": ' . json_encode($amount) . ',
      "returnUrl": "http://127.0.0.1:8000/transactions/uba/returnoute",
      "hash":' . json_encode($hash) . '
      }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: PHPSESSID=qc0mb9sou5kmqpl5ndn6v7bec0; SERVERID=s1; ci_session_ubfe_gh='
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

    echo $response;
  }


  static public function getTransaction( $ref)
  {

 
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://gh.instantbillspay.com/instantpay/api/bill/refstatus?ref='.$ref.'',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=259cvppoim9aapf28ho6thnmus; SERVERID=s1; ci_session_ubfe_gh=VDQBOlIyATwLIFUmBjtVYw9hVDwIc1ZxADULIAd6Uj8JOlJpXAMPMgdiXX5dMwRwVT8BMgw5VWhdIQNkDWJQPFNhATsEO1NmDjYHZ11vVzFUZAEzUjIBMws9VWUGN1VrD2NUNwhpVjsAMgtgBzBSbgkwUmJcZQ9tBzVdfl0zBHBVPwEwDDtVaF0hAzgNJFBbU2IBPQRuUyUONwchXS5XIVRuAXNSPQE3C2hVbwYjVWMPaFQ0CH9WMwBmC2sHJ1JjCWdSKVxuD2IHJF1nXXsEOVU0ATEMMVVwXXYDIg0xUHZTXAE4BG1TMg48ByZdf1c4VCYBOlI1ATcLYVV3BlFVPQ8iVHIIPFZjAD4LAQd8UjgJIVJuXDEPPgcpXWtdJgQxVTwBLww5VXBdOAMiDW5QNVMwAWMEKFM7DjMHIV0pV1xUNAFjUnMBbwstVTwGdVUrD3NUPQg4VjgAYQtlBz9SbglhUjVcbA9uBzddbl0zBHBVPwE4DDFVcF12AyINMVB2U1wBPQRrUyMOMwdwXWZXcFRvATBSPQEkC3lVbgZ834ccb87f0076b3f9468104351d0085b5c339306a'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
  
    
return $response;

  }
  static public function getTransactions()
  {
  }
}
