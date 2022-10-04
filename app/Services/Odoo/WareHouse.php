<?php
namespace App\Services\Odoo;
use App\Services\Odoo\Config;

class WareHouse{

    static public function getShops()
    {

        $ids = Config::client()->search('res.branch', [['id', '!=', 0]], 0, 100);
        $fields = ['name', 'id'];
        $shops = Config::client()->read('res.branch', $ids, $fields);
        return  $shops;
    }


    static public function getShop($id)
    {

        $ids = Config::client()->search('res.branch', [['id', '=', $id]], 0, 1);

        $fields = ['name', 'id', ];
        $att = Config::client()->read('res.branch', $ids, $fields);
        return $att;
    }



// get shops fields
    static public function shopFields()
    {

        $data =  Config::client()->fields_get('hr.employee.public', array(), array('attributes' => array('string', 'help', 'type')));
        return $data;
    }
   
    


}