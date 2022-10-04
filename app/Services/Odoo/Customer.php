<?php
namespace App\Services\Odoo;
use App\Services\Odoo\PConfig;

class Customer{


    static public function getCustomers()
    {

        $ids = Config::clienttest()->search('res.partner', [['id', '!=',0]], 0, 10);
        $fields = ['name', 'id', 'phone', 'email'];
        $att = Config::clienttest()->read('res.partner', $ids, $fields);
        return $att;
    }




    static public function getCustomer($phone)
    {
        
        $ids = Config::clienttest()->search('res.partner', [['phone', '=', $phone]], 0, 1);

        $fields = ['name', 'id', 'phone', 'email'];
        $att = Config::clienttest()->read('res.partner', $ids, $fields);
        return $att;
    }

    static public function branch($name)
    {
        
        $ids = Config::clienttest()->search('res.branch', [['name', 'like', '%'.$name.'%']], 0, 1);

        $fields = ['name', 'id','bank_journal_id'];
        $att = Config::clienttest()->read('res.branch', $ids, $fields);
        return $att;
    }


    static public function creatCustomer($data)
    {
        $ids = Config::clienttest()->create('res.partner', $data);
       
        
    }

    static public function deposit($data)
    {
        $ids = Config::clienttest()->create('account.payment', $data);
         return$ids;
       
        
    }



    static public function updateCustomer($data)
    {
        $ids = Config::clienttest()->search('res.partner', [['phone', '=', $data['phone']]], 0, 1);

        $ids = Config::clienttest()->write('res.partner',$ids, $data);
        
        
    }








// get customer fields
    static public function customerFields()
    {

        $data =  Config::client()->fields_get('res.partner', array(), array('attributes' => array('string', 'help', 'type')));
        return $data;
    }

    static public function accountFields()
    {

        $data =  Config::client()->fields_get('account.payment', array(), array('attributes' => array('string', 'help', 'type')));
        return $data;
    }

    static public function branchFields()
    {

        $data =  Config::client()->fields_get('res.branch', array(), array('attributes' => array('string', 'help', 'type')));
        return $data;
    }
   





    // go
    


}