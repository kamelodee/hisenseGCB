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
      "returnUrl": "https://api.hisense.com.gh/payments/processing",
      "hash":' . json_encode($hash) . '
      }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: PHPSESSID=qc0mb9sou5kmqpl5ndn6v7bec0; SERVERID=s1; ci_session_ubfe_gh=VjZaYVY2VWhSeVIhDDEEMglnVz8KcQEmVGEPJAN%2BAm8KOQU%2BDVIEOQVgCyhTPQZyUDoBMlBlBzoLdwRuCWEANwFmCWZSbQU0CmEGZVhuAjRWZlo4VjZVZFJkUmoMbwQ7CTVXPQpmAWVUPQ9jAzkCNgpiBTENawRhBWULKFM9BnJQOgEwUGcHOgt3BD8JIAALATAJNVI4BXMKMwYgWCsCdFZsWihWOVVjUjFSaAwpBDIJblc3Cn0BZFQyD28DIwIzCmQFfg0%2FBGkFJgsxU3UGO1AxATFQbQciCyAEJQk1ACYBDgkwUjsFZAo4BidYegJtViRaYVYxVWNSOFJwDFsEbAkkV3EKPgE0VGoPBQN4AmgKIgU5DWAENQUrCz1TKAYzUDkBL1BlByILbgQlCWoAZQFiCWtSfgVtCjcGIFgsAglWNlo4VndVO1J0UjsMfwR6CXVXPgo6AW9UNQ9hAzsCPgpnBWgNOQRoBTMLOFM9BnJQOgE4UG0HIgsgBCUJNQAmAQ4JNVI9BXUKNwZxWGMCJVZtWmtWOVVwUiBSaQx2b01061ed4d6e8336fc840cb6fb6bc1233bc3a8cd'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

    return $response;
  }


  static public function getTransactions()
  {
  }
}
