<?php
namespace App\Services\Banks;
use Illuminate\Support\Facades\DB;
use App\Services\Helper;

class CalBank{
 

    static public function pay($amount,$phone,$name,$order_code,$customer_city,$id)
    {
      $mai = Helper::username($id,$name);
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://calpayapi.caleservice.net/api/calpay',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "requestType": "CreateInvoice",
            "merchant": {
                "emailOrMobileNumber": "CALPAYDEMO@CALBANK.NET",
                "apikey": "LIVE-rjT6GlZzdOCesUUBFlnYhtWvapOgJh51",
                "type": "EMAIL",
                "env": "LIVE",
                "destinationaccount": "",
                "sbmerchantid": ""
            },
            "payment":{
                "accounttype":"",
                "accountnumber":"",
                "mode":""
            },
            "orderItems": [
                {
                    "unitPrice": 0.2,
                    "itemName": "TEST",
                    "quantity": 1,
                    "itemCode": "EMPCA",
                    "discountAmount": 0,
                    "subTotal": 0.2
                }
            ],
            "order": {
                "customerAddressCity": '.json_encode($customer_city).',
                "otherData": "TEST",
                "datacompleteurl": "https://caclbank.net",
                "sendInvoice": "FALSE",
                "description": "PAYMENT FOR ITEM",
                "tax": 0,
                "customerName": '.json_encode($name).',
                "customerCountry": "GHA",
                "datacancelurl": "https://caclbank.net",
                "totalAmount": '.json_encode($amount).',
                "shipping": 0,
                "customerContact": '.json_encode($phone).',
                "trasactionCardMode": "PURCHASE",
                "customerEmail": '.json_encode(str_replace(' ', '', $mai).'@gmail.com').',
                "payOption": "ALL",
                "currency": "GHS",
                "approveurl" : "https://www.pay.hisense.com.gh/payments/processing",
                "orderCode": '.json_encode($order_code).',
                "callbackurl": "https://caclbank.net",
                "fullDiscountAmount": 0
            }
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'x-auth: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtY29kZSI6Ik1DSC00NDE3Njc4NyIsImlkIjoiMTgiLCJpYXQiOjE1ODQ0NzA1ODV9.wMeo6m9FC5hT4OY08edKBQZR0ykXCSpwM1BLGobeJmM',
            'Cookie: cookiesession1=2813EBC4XQMUKYQVBPE6Q6S8JA4ZFD5E'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
      return  $data = json_decode($response);
    }

    
    static public function getTransactions($transaction_id)
    {
      $curl = curl_init();
            
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://calpayapi.caleservice.net/api/calpay',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
          "requestType": "GetInvoiceDetails",
          "paymentToken": '.json_encode($transaction_id).'
      }',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'x-auth: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtY29kZSI6Ik1DSC00NDE3Njc4NyIsImlkIjoiMTgiLCJpYXQiOjE1ODQ0NzA1ODV9.wMeo6m9FC5hT4OY08edKBQZR0ykXCSpwM1BLGobeJmM',
          'Cookie: cookiesession1=2813EBC41UMQXWODFEH3TGSYBBZM5EC4'
        ),
      ));
      
      $response = curl_exec($curl);
      // FINALSTATUS
      curl_close($curl);
      return $data = json_decode($response); 
    }


    
}