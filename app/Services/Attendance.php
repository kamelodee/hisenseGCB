<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use Ripoo\OdooClient;
use App\Models\Atendance;
use PhpXmlRpc\Value;
use PhpXmlRpc\Request;
use PhpXmlRpc\Client;
use Carbon\Carbon;

class Attendance{
 const  URL = "https://owia.odoo.com";
    const  DB = 'odoo-ps-psbe-sun-electronics-main-1649702';
    const USERNAME = 'staff.attendance';
    const  PASSWORD = 'h15E-ff47S!-6c561261a';

    static public function client()
    {
        return new OdooClient(self::URL, self::DB, self::USERNAME, self::PASSWORD);
    }


    static public function ProductFields()
    {

        $data =  self::client()->fields_get('hr.attendance', array(), array('attributes' => array('string', 'help', 'type')));
        return $data;
    }
}