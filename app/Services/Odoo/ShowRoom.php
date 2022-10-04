<?php
namespace App\Services\Odoo;
use App\Services\Odoo\Config;

class ShowRoom {
    
    static public function getShops()
    {

        $ids = Config::client()->search('res.branch', [['id', '!=', 0]], 0, 100);
        $fields = ['name', 'id','street','city','phone','warehouse_id'];
        $shops = Config::client()->read('res.branch', $ids, $fields);
        return  $shops;
    }


    static public function getStock()
    {

        $ids = Config::client()->search('stock.quant', [['company_id', '=', 2]], 0, 1000);
        $fields = ['id','product_tmpl_id','product_categ_id','quantity','location_id','company_id'];
        $shops = Config::client()->read('stock.quant', $ids, $fields);
        return  $shops;
    }


    static public function getShop($id)
    {
        // $id_ = intval( $id );
        $ids = Config::client()->search('res.branch', [['id', '=',$id]], 0, 1);

        $fields = ['name', 'id','street','city','phone','warehouse_id'];
        $att = Config::client()->read('res.branch', $ids, $fields);
        $ids = Config::client()->search('stock.warehouse', [['id', '=',$att[0]['warehouse_id'][0]]], 0, 1);
        $fields = ['name', 'id','wh_qc_stock_loc_id','wh_input_stock_loc_id','wh_output_stock_loc_id'];
        $att = Config::client()->read('stock.warehouse', $ids, $fields);
        return $att;
    }

    static public function branchFields()
    {

        $data =  Config::client()->fields_get('stock.warehouse', array(), array('attributes' => array('string', 'help', 'type')));
        return $data;
    }

    static public function stockFields()
    {

        $data =  Config::client()->fields_get('stock.quant', array(), array('attributes' => array('string', 'help', 'type')));
        return $data;
    }

}