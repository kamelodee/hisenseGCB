<?php

namespace App\Services;



class Helper
{


    static public function tranId($id){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $cha =substr(str_shuffle($characters), 7, 7);
        $ref = sprintf('%s%s%s',now()->format('His'),$cha ,$id);
        return $ref;
    }
    

    static public function username($id,$name){
        if(strlen($name) < 8){
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
           $cha =substr(str_shuffle($characters), 5, 10);
           $na = $name.$cha;
           $cha =substr(str_shuffle(strtoupper(str_replace(' ', '', $na))), 5, 5);
          $ref = sprintf('%s%s','SO'.$id,now()->format('His'));
          return $ref;
        }else{
            $cha =substr(str_shuffle(strtoupper(str_replace(' ', '', $name))), 5, 5);
            $ref = sprintf('%s%s','SO'.$id,now()->format('His') ); 
            return $ref;  
        }
        
       
    }
    
}