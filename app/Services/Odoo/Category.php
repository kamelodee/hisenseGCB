<?php
namespace App\Services\Odoo;
use App\Services\Odoo\Config;

class Category{


// all category
    static public function allCategory()
    {

        $ids = Config::client()->search('product.category', [['name', 'in', ['Air Conditioner','Kitchen Appliances','Mobile Phones','Refrigeration','Televisions','Washing Machine']]], 0, 1000);
        if($ids){
        $fields = ['id','name', 'product_count','complete_name'];
        $customers = Config::client()->read('product.category', $ids, $fields);
        return $customers;
        }else{
            return [];
        }
    }


    // single Category
    static public function singleCategory($id)
    {

        $ids = Config::client()->search('product.category', [['id', '=', $id]], 0, 1);
        if($ids){
        $fields = ['name', 'id', 'parent_id', 'child_id'];
        $att = Config::client()->read('product.category', $ids, $fields);

        return $att;
        }else{
            return [];
        }

    }


    static public function subCategory($id)
    {

        $id = Config::client()->search('product.category', [['id', '=', $id]], 0, 1);
      if($id){
        $fields = ['child_id'];
        $att = Config::client()->read('product.category', $id, $fields);
        // retun
        if($att[0]['child_id']){
            $ids = Config::client()->search('product.category', [['id', 'in', $att[0]['child_id']]], 0, 100);
            $fields = ['name', 'id', 'parent_id', 'child_id','product_count','complete_name'];
            $categories = Config::client()->read('product.category', $ids, $fields);
        }else{
            return [];
        }
        
       return  $categories;
      }else{
        return [];
      }

    }





// get category fields
    static public function categoryFields()
    {

        $data =  Config::client()->fields_get('product.category', array(), array('attributes' => array('string', 'help', 'type')));
        return $data;
    }
    

}