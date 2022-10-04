<?php

namespace App\Services\Odoo;

use Illuminate\Support\Facades\DB;
use Ripoo\OdooClient;
use App\Models\Atendance;
use PhpXmlRpc\Value;
use PhpXmlRpc\Request;
use PhpXmlRpc\Client;
use Carbon\Carbon;

class Config
{

    const  URL = "https://owia.odoo.com";
    const  DB = 'odoo-ps-psbe-sun-electronics-main-1649702';
    const USERNAME = 'odoo.mobile.user';
    const  PASSWORD = 'Ggi3M6T!zRizNFhn-96811783e9aac11160a';

    const  URL1 = "https://owia-v15-staging-5502646.dev.odoo.com";
    const  DB1 = 'owia-v15-staging-5502646';
    const USERNAME1 = 'odoo.mobile.user';
    const  PASSWORD1 = 'Ggi3M6T!zRizNFhn-96811783e9aac11160a';

    // const  URL = "https://owia.odoo.com";
    // const  DB = 'odoo-ps-psbe-sun-electronics-main-1649702';
    // const USERNAME = 'staff.attendance';
    // const  PASSWORD = 'h15E-ff47S!-6c561261a';

    // const  URL = "https://owia-14-0-staging-4241215.dev.odoo.com";
    // const  DB = 'owia-14-0-staging-4241215';
    // const USERNAME = 'testing@attendance';
    // const  PASSWORD = 'e61f96c561261a4da20443b81d2b620962683828c';



    static public function client()
    {
        return new OdooClient(self::URL, self::DB, self::USERNAME, self::PASSWORD);
    }

    static public function clienttest()
    {
        return new OdooClient(self::URL1, self::DB1, self::USERNAME1, self::PASSWORD1);
    }


    static protected function odologin()
    {
        $connexion = new Client(self::URL . "/xmlrpc/2/common");
        $response = $connexion->send(new Request('login', array(new Value(self::DB), new Value(self::USERNAME), new Value(self::PASSWORD))));
        $connexion->setSSLVerifyPeer(0);
        return $response;
    }





    static public function updateAttendance($ids, $check_out)
    {

        $c_response = self::odologin();


        //   dd($ids[0]);
        if ($c_response->errno != 0) {
            echo  '<p>error : ' . $c_response->faultString() . '</p>';
        } else {
            $uid = $c_response->value()->scalarval();

            $val = array(
                "check_out"    => new Value($check_out),
            );
            $id_list = array();
            $id_list[] = new Value($ids[0], 'int');
            $client = new Client(self::URL . "/xmlrpc/2/object");
            $client->setSSLVerifyPeer(0);


            $response = $client->send(new Request('execute', array(
                new Value(self::DB),
                new Value($uid),
                new Value(self::PASSWORD),
                new Value("hr.attendance"),
                new Value("write"),
                new Value($id_list, "array"),
                new Value($val, "struct"),

            )));

            if ($response->errno != 0) {
                return true;
            }
        }
    }






    // create customer
    static public function createAtt($data)
    {


        $c_response = self::odologin();

        if ($c_response->errno != 0) {
            echo  '<p>error : ' . $c_response->faultString() . '</p>';
        } else {
            $uid = $c_response->value()->scalarval();

            $val = array(
                "check_in"    => new Value($data["check_in"]),
                "employee_id"    => new Value($data["employee_id"]),

            );


            $client = new Client(self::URL . "/xmlrpc/2/object");
            $client->setSSLVerifyPeer(0);


            $response = $client->send(new Request('execute', array(
                new Value(self::DB),
                new Value($uid),
                new Value(self::PASSWORD),
                new Value("hr.attendance"),
                new Value("create"),
                new Value($val, "struct"),

            )));

            if ($response->errno != 0) {

                return 0;
                info('-------------------------error--------');
                info($response->errstr);
            } else {
                info($response);
                return 1;
            }
        }
    }

    


}
