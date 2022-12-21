<?php

namespace App\Services\Banks;

use Illuminate\Support\Facades\DB;


class EcoBank
{


  static public function pay($name, $phone, $amount, $order_code)
  {
    // return $phone;
    $name = explode(" ", $name);
    $string = 'invoice_id='.$order_code.'&merchant_key='.env('ECOBANK_URL').'&total='.$amount.'';
    $hash = hash_hmac('sha512', $string, 'ef1b90404c24dab68acd39e0ce51f1112c9fc760');

   

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => env('ECOBANK_URL'),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "merchant_key":'.json_encode(env('ECOBANK_PRO_KEY')).',
        "invoice_id":'.json_encode($order_code).',
        "success_url":'.json_encode(env('SUCCESS_URL').'?ref='.$order_code).',
        "cancelled_url":'.json_encode(env('CANCELED_URL')).',
        "number":'.json_encode($phone).',
        "email":"hisensecustomer@gmail.com",
        "name":'.json_encode($name).',
        "description":"payment",
        "pn_url":"https://api.hisense.com.gh",
        "extra_outlet":"https://api.hisense.com.gh",
        "generate_checkout_url":"https://api.hisense.com.gh",
        "total":'.json_encode($amount).'
       
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    return $response;
    

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => env('ECOBANK_URL'),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "merchant_key":"tk_a7f5af0c-715a-11ed-b603-f23c9170642f",
        "invoice_id":'.json_encode($order_code).',
        "success_url":'.env('SUCCESS_URL').',
        "cancelled_url":'.env('CANCELED_URL').',
        "number":'.json_encode($phone).',
        "email":"customer@gmail.com",
        "name":'.json_encode($name).',
        "description":"",
        "secure_hash":'.json_encode($hash).',
        "total":'.json_encode($amount).'
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    return $response;
    
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
