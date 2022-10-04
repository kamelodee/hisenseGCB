<?php
namespace App\Services\Odoo;
use App\Services\Odoo\Config;

class Product{

    static public function getProducts()
    {

        $ids = Config::client()->search('product.product', [['id', '!=', 0]], 0, 100);
        if($ids){
        $fields = ['price','name', 'product_tmpl_id', 'barcode', 'product_template_attribute_value_ids', 'product_template_variant_value_ids', 'is_product_variant', 'standard_price', 'image_variant_1920'];
        return Config::client()->read('product.product', $ids, $fields);
        }else{
            return [];
        }
    }


    static public function getProduct($check_in)
    {

        $ids = Config::client()->search('product.product', [['id', '=', 0]], 0, 1);
        if($ids){
        $fields = ['price', 'id', 'product_tmpl_id', 'barcode','product_template_attribute_value_ids','name'];
        $att = Config::client()->read('product.product', $ids, $fields);
        return $att;
        }else{
            return [];
        }
    }




    static public function getProductTemplates()
    {

        $ids = Config::client()->search('product.template', [['list_price', '>', 0]], 0, 100);
        if($ids){
        $fields = ['name', 'description','list_price','qty_available','warehouse_id', 'price', 'type', 'categ_id', 'location_id', 'warehouse_id', 'branch_id','barcode','x_warranty_measure'];
        $products = Config::client()->read('product.template', $ids, $fields);
        return $products;
        }else{
            return [];
        }
    }


    static public function getProductTemplate($id)
    {

        $ids = Config::client()->search('product.template', [['check_in', '=', $id]], 0, 1);
        if($ids){
            $fields = ['name', 'description','list_price','qty_available', 'price', 'type', 'categ_id', 'standard_price', 'product_variant_ids', 'product_variant_id','barcode','uom_name'];
        $att = Config::client()->read('product.template', $ids, $fields);
        return $att;
        }else{
            return [];
        }
    }



    static public function getProductByCategoryId($id)
    {
        $ids = Config::client()->search('product.category', [['id', '=', $id]], 0, 1);
        if($ids){
        $ids = Config::client()->search('product.template', [['categ_id', 'in', $ids]], 0, 1000);
        if($ids){
            $fields = ['name', 'description','list_price','qty_available', 'price', 'type', 'categ_id', 'standard_price', 'product_variant_ids', 'product_variant_id','barcode','uom_name'];
        return  Config::client()->read('product.template', $ids, $fields);
        }else{
            return [];
        }
        }else{
            return [];
        }
    }

    static public function getTelivionSize($size)
    {
        
       
        $ids = Config::client()->search('product.template', [['name', 'like', '%'.$size.'% %Television%']], 0, 100);
        if($ids){
            $fields = ['name', 'description','list_price','qty_available', 'price', 'type', 'categ_id', 'standard_price', 'product_variant_ids', 'product_variant_id','barcode','uom_name'];
        return  Config::client()->read('product.template', $ids, $fields);
        }else{
            return [];
        }
       
    }


    // search
    static public function search($query)
    {
        
       
        $ids = Config::client()->search('product.template', [['name', '=like', '%'.$query.'%']], 0, 100);
        if($ids){
            $fields = ['name', 'description','list_price','qty_available', 'price', 'type', 'categ_id', 'standard_price', 'product_variant_ids', 'product_variant_id','barcode','uom_name'];
        return  Config::client()->read('product.template', $ids, $fields);
        }else{
            return [];
        }
       
    }

    

  



// get product fields
    static public function ProductFields()
    {

        $data =  Config::client()->fields_get('product.product', array(), array('attributes' => array('string', 'help', 'type')));
        return $data;
    }

    static public function ProductTemplateFields()
    {

        $data =  Config::client()->fields_get('product.template', array(), array('attributes' => array('string', 'help', 'type')));
        return $data;
    }
   
    


}