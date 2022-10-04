<?php

namespace App\Http\Controllers\Odoo;

use App\Services\Odoo\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ripoo\Exception\{CodingException, ResponseException, ResponseEntryException, ResponseFaultException, ResponseStatusException};

class ProductController extends Controller
{

    public function getProducts()
    {
        try {

            $products = Product::getProducts();
            if (count($products) > 0) {
                return response()->json([
                    'products' => $products,
                    'statusCode' => 200,

                ], 200);
            } else {
                return response()->json([
                    'message' => 'No Products Available',
                    'statusCode' => 404,

                ], 404);
            }
        } catch (ResponseException $e) {
            report($e);

            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
    }


    // products
    public function getProduct($id)
    {
        try {
            $product = Product::getProducts($id);
            if (count($product) > 0) {
                return response()->json([
                    'products' => $product,
                    'statusCode' => 200,

                ], 200);
            } else {
                return response()->json([
                    'message' => 'No Products Available',
                    'statusCode' => 404,

                ], 404);
            }
        } catch (ResponseException $e) {
            report($e);

            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
    }


    // product fieds
    public function productFields()
    {
        return Product::ProductFields();
    }


    // product templates
    public function getProductTemplates()
    {
        try {
            $newproducts =[];
        $products = Product::getProductTemplates();
            foreach($products as $product){
                //   $str = preg_replace('/\n\\n \t/', ' ', $product['description']);
             $des =   preg_split("/<[^>]*[^\/]>/i", $product['description']);
             $pro = [
                'id'=>$product['id'],
                'name'=>$product['name'],
                'description'=>$des,
                'sales_price'=>$product['list_price'],
                // 'location_id'=>$product['x_stock_location'],
                'available_quantity'=>$product['qty_available'],
                'image_1920'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_1920&unique=19072022165556',
                'image_1024'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_1024&unique=19072022165556',
                'image_512'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_512&unique=19072022165556',
                'image_256'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_256&unique=19072022165556',
                'image_128'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_128&unique=19072022165556',
                
             ];
             
            array_push($newproducts,$pro);
            }
            if (count($products) > 0) {
                return response()->json([
                    'products' => $newproducts,
                    'statusCode' => 200,

                ], 200);
            } else {
                return response()->json([
                    'message' => 'No Products Available',
                    'statusCode' => 404,

                ], 404);
            }
        } catch (ResponseException $e) {
            info($e);

            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
    }


    // product templates
    public function getProductTemplate($id)
    {
        try {
            $product = Product::getProductTemplate($id);
            if (count($product) > 0) {
                return response()->json([
                    'products' => $product,
                    'statusCode' => 200,

                ], 200);
            } else {
                return response()->json([
                    'message' => 'No Products Available',
                    'statusCode' => 404,

                ], 404);
            }
        } catch (ResponseException $e) {
            report($e);

            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
    }


    
    public function getProductByCategoryId($id)
    {
        // return $id;
        try {
            $products = Product::getProductByCategoryId($id);
            
            if (count($products) > 0) {

                $newproducts =[];
                foreach($products as $product){
                    // $str = preg_replace('/\<li>\<li>+/', '', $product->description);
                 $pro = [
                    'id'=>$product['id'],
                    'name'=>$product['name'],
                    'description'=>$product['description'],
                    'sales_price'=>$product['list_price'],
                    'available_quantity'=>$product['qty_available'],
                    'image_1920'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_1920&unique=19072022165556',
                    'image_1024'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_1024&unique=19072022165556',
                    'image_512'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_512&unique=19072022165556',
                    'image_256'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_256&unique=19072022165556',
                    'image_128'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_128&unique=19072022165556',
                    
                 ];
                 
                array_push($newproducts,$pro);
                }

                return response()->json([
                    'products' => $newproducts,
                    'statusCode' => 200,

                ], 200);
            } else {
                return response()->json([
                    'message' => 'No Products Available',
                    'statusCode' => 404,

                ], 404);
            }
        } catch (ResponseException $e) {
            report($e);

            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
    }


    // televition size
    public function getTelivionSize($id)
    {
        // return $id;
        try {
            $products = Product::getTelivionSize($id);
            
            if (count($products) > 0) {

                $newproducts =[];
                foreach($products as $product){
                    // $str = preg_replace('/\<li>\<li>+/', '', $product->description);
                 $pro = [
                    'id'=>$product['id'],
                    'name'=>$product['name'],
                    'description'=>$product['description'],
                    'sales_price'=>$product['list_price'],
                    'available_quantity'=>$product['qty_available'],
                    
                    'image_1920'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_1920&unique=19072022165556',
                    'image_1024'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_1024&unique=19072022165556',
                    'image_512'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_512&unique=19072022165556',
                    'image_256'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_256&unique=19072022165556',
                    'image_128'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_128&unique=19072022165556',
                    
                 ];
                 
                array_push($newproducts,$pro);
                }

                return response()->json([
                    'products' => $newproducts,
                    'statusCode' => 200,

                ], 200);
            } else {
                return response()->json([
                    'message' => 'No Products Available',
                    'statusCode' => 404,

                ], 404);
            }
        } catch (ResponseException $e) {
            report($e);

            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
    }

    // search size
    public function search($query)
    {
        // return $id;
        try {
            $querycap =ucwords($query);
            $products = Product::search($querycap);
            
            if (count($products) > 0) {

                $newproducts =[];
                foreach($products as $product){
                    // $str = preg_replace('/\<li>\<li>+/', '', $product->description);
                 $pro = [
                    'id'=>$product['id'],
                    'name'=>$product['name'],
                    'description'=>$product['description'],
                    'sales_price'=>$product['list_price'],
                    'available_quantity'=>$product['qty_available'],
                    
                    'image_1920'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_1920&unique=19072022165556',
                    'image_1024'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_1024&unique=19072022165556',
                    'image_512'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_512&unique=19072022165556',
                    'image_256'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_256&unique=19072022165556',
                    'image_128'=>'https://owia.odoo.com/web/image?model=product.template&id='.$product['id'].'&field=image_128&unique=19072022165556',
                    
                 ];
                 
                array_push($newproducts,$pro);
                }

                return response()->json([
                    'products' => $newproducts,
                    'statusCode' => 200,

                ], 200);
            } else {
                return response()->json([
                    'message' => 'No Products Available',
                    'statusCode' => 404,

                ], 404);
            }
        } catch (ResponseException $e) {
            report($e);

            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
    }


    // product template fields
    public function productTemplateField()
    {
        return Product::ProductTemplateFields();
    }
}
