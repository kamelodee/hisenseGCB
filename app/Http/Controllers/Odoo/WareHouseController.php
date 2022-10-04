<?php

namespace App\Http\Controllers\Odoo;


use App\Services\Odoo\ShowRoom;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ripoo\Exception\{CodingException, ResponseException, ResponseEntryException, ResponseFaultException, ResponseStatusException};

class WareHouseController extends Controller
{
   
    
    public function getShops()
    {
        return ShowRoom::getShops();

    }
    

// 
    public function getShop($id)
    {
        return ShowRoom::getShop($id);
    }


    public function getStock()
    {
        return ShowRoom::getStock();
    }


    public function branchFields()
    {
         return ShowRoom::branchFields();
    }


    public function getShopFields()
    {
         return ShowRoom::stockFields();
    }

}
