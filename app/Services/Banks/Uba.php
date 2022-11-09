<?php
namespace App\Services\Banks;
use Illuminate\Support\Facades\DB;


class Uba{
 

    static public function pay($name,$phone,$amount,$order_code)
    {
        $name = explode(" ", $name);

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://main.testinstantbillspay.com.ng/instantpay/payload/bill/makepayment?Key=keyval&value=99f3d937d8043faaa6b2c346dfcddbc41b269cef',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
        "email":"test@gmail.com",
        "firstname":'.$name[0].',
        "lastname":'.$name[1].',
        "phone": '.$phone.',
        "merchantID" : "NG0700144",
        "uniqueID": '.$order_code.',
        "description": " test test description",
        "amount": '.$amount.',
        "successReturnUrl": "https:// xyz.com/success-page",
        "cancelReturnUrl": "https:// xyz.com/cancel-page",
        "failureReturnUrl": "https:// xyz.com/failure-page"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: PHPSESSID=lthkh3ac9df99qn1p2jiehj6e3; ci_session_ubfe=dAoHoi1VPp5%2FcRyQP15KsGghb7ir2B%2FDuu6rBz2NjQtEuT9wiwNd8%2F4S0w41%2FImszlDNmdzyhN%2BaSNDiQLnU9MS5drvmocKPBxgLrJgnXYHSDj6GLLl3z5qODXLbg6Jdz3%2BKftCHHpi87rp8aHM60hamoXW%2FnAc8jLJmrYm48OFAj0DnVfyC74MfgvaCpxUAO%2BLjNPuxQ3ZIOoL7j8zw18ATOXhwC%2FcDIh2qeriJHGTTMJsbIz1TJ2r55dsXD%2FHL9nRlfM4VmnOSbDa%2FANWYwX0IXpohAAcZd2N71I%2BLpBL4u4dUDBGUBWDhZGFkgXtrPSw85SJrOIqr6DlmiE2zZQ%3D%3D0ad74abdd5f756720eda39d44b98773a875536cb'
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