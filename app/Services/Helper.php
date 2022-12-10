<?php

namespace App\Services;

use NumberFormatter;
use App\Models\Transaction;
use DataTables;
use App\Services\Banks\CalBank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
class Helper
{


    static public function money($number){
        $amount = new NumberFormatter("en_US", NumberFormatter::CURRENCY);
            return  $amount->formatCurrency($number, 'GHC');
    }
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

    static public function datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='',$bank='',$request){
       $trans =[];

       if(!empty($showroom)){
        if(!empty($date1)  && !empty($transaction_type)&& empty($period) && empty($bank) ){
            $trans = Transaction::where('showroom',$showroom)->where('transaction_type',$transaction_type)->whereBetween('created_at', array($date1, $date2))->latest();

        }

        if(empty($date1) && !empty($transaction_type) && empty($period) && empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->where('transaction_type',$transaction_type)->latest();

        }
        if(empty($date1) && empty($transaction_type) && empty($period) && empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->latest();

        }

        if(!empty($date1) && empty($transaction_type) && empty($period) && empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->whereBetween('created_at', array($date1, $date2))->latest();

        }
        if(!empty($date1) && empty($transaction_type) && empty($period) && empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->whereBetween('created_at', array($date1, $date2))->latest();

        }
        if(!empty($date1) && empty($transaction_type) && empty($period) && !empty($bank)){
            
            $trans = Transaction::where('showroom',$showroom)->where('bank',$bank)->whereBetween('created_at', array($date1, $date2))->latest();

        }
        if(!empty($date1) && empty($transaction_type) && empty($period) && !empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->where('bank',$bank)->whereBetween('created_at', array($date1, $date2))->latest();

        }
        if(empty($date1) && empty($transaction_type) && empty($period) && !empty($bank)){
          
            $trans = Transaction::where('showroom',$showroom)->where('bank',$bank)->latest();

        }

        if(empty($date1) && !empty($transaction_type) && empty($period) && !empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->where('transaction_type',$transaction_type)->where('bank',$bank)->latest();

        }
       
        if( $period =='week' && empty($bank)){
            $currentDate = Carbon::now();
            $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
            $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
             
        $trans = Transaction::where('showroom',$showroom)->whereBetween('created_at', [$nowDate, $nextweekdate])->latest();
      
        }
        if( $period =='week' && !empty($bank)){
            $currentDate = Carbon::now();
            $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
            $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
             
        $trans = Transaction::where('bank',$bank)->where('showroom',$showroom)->whereBetween('created_at', [$nowDate, $nextweekdate])->latest();
      
        }
        if($period =='month' && empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->whereMonth('created_at', Carbon::now()->month)->latest();

        }
        if($period =='month' && !empty($bank)){
            $trans = Transaction::where('bank',$bank)->where('showroom',$showroom)->whereMonth('created_at', Carbon::now()->month)->latest();

        }
        if($period =='year' && empty($bank)){
            
            $trans = Transaction::where('showroom',$showroom)->whereYear( 'created_at', Carbon::now()->year)->latest();
 
         }
        if($period =='year' && !empty($bank)){
            
            $trans = Transaction::where('bank',$bank)->where('showroom',$showroom)->whereYear( 'created_at', Carbon::now()->year)->latest();
 
         }
         if($period =='today' && empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->whereDay('created_at',Carbon::now())->latest();

        }
         if($period =='today' && !empty($bank)){
            $trans = Transaction::where('bank',$bank)->where('showroom',$showroom)->whereDay('created_at',Carbon::now())->latest();

        }

       
       }

       if(empty($showroom)){
        // no show room
        
        if(!empty($date1)  && !empty($transaction_type) && empty($period) && empty($bank)){
           
            $trans = Transaction::where('transaction_type',$transaction_type)->whereBetween('created_at', array($date1, $date2))->latest();

        }

        if(!empty($transaction_type) && empty($period) && empty($date1) && empty($bank)){
            $trans = Transaction::where('transaction_type',$transaction_type)->latest();

        }

        if(!empty($date1) && empty($period) && empty($transaction_type) && empty($bank)){
            $trans = Transaction::whereBetween('created_at', array($date1, $date2))->latest();

        }
        if(!empty($date1) && empty($period) && empty($transaction_type) && !empty($bank)){
            $trans = Transaction::whereBetween('created_at', array($date1, $date2))->where('bank',$bank)->latest();

        }
        if(!empty($date1) && empty($period) && !empty($transaction_type) && !empty($bank)){
            $trans = Transaction::whereBetween('created_at', array($date1, $date2))->where('bank',$bank)->where('transaction_type',$transaction_type)->latest();

        }
        if(empty($date1) && empty($period) && !empty($transaction_type) && !empty($bank)){
            $trans = Transaction::where('bank',$bank)->where('transaction_type',$transaction_type)->latest();

        }
        if(empty($date1) && empty($period) && empty($transaction_type) && !empty($bank)){
            $trans = Transaction::where('bank',$bank)->latest();

        }
        if(empty($date1) && empty($period) && empty($transaction_type) && empty($bank)){
            $trans = Transaction::latest();

        }
        if($period =='week' && empty($bank)){
            $currentDate = Carbon::now();
            $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
            $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
             
        $trans = Transaction::whereBetween('created_at', [$nowDate, $nextweekdate])->latest();
      
        }
        if($period =='week' && !empty($bank)){
            $currentDate = Carbon::now();
            $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
            $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
             
           $trans = Transaction::where('bank',$bank)->whereBetween('created_at', [$nowDate, $nextweekdate])->latest();
      
        }

        if($period =='month' && empty($bank)){
            $trans = Transaction::whereMonth('created_at', Carbon::now()->month)->latest();

        }
        if($period =='month' && !empty($bank)){
            $trans = Transaction::where('bank',$bank)->whereMonth('created_at', Carbon::now()->month)->latest();

        }
        if($period =='year' && empty($bank)){
         
            $trans = Transaction::whereYear( 'created_at', Carbon::now()->year)->latest();

        }
        if($period =='today' && empty($bank)){
            $trans = Transaction::whereDay('created_at',Carbon::now())->latest();

        }
        if($period =='today' && !empty($bank)){
            $trans = Transaction::where('bank',$bank)->whereDay('created_at',Carbon::now())->latest();

        }
        
       
       }
    
         return self::transist($request,$trans);

           }
    

    public static function transist( $request,$trans)
    {
      

        if($request->ajax()){
            // return $trans;
            return DataTables::eloquent($trans)
            ->filter(function ($query) {
                if (request()->has('search')) {
                    $query->where('showroom', 'like', "%" . request('search') . "%")
                    ->orWhere('sales_reference_id', 'like', "%" . request('search') . "%")
                    ->orWhere('transaction_type', 'like', "%" . request('search') . "%")
                    ->orWhere('ref', 'like', "%" . request('search') . "%")
                    ->orWhere('phone', 'like', "%" . request('search') . "%")
                    ->orWhere('customer_name', 'like', "%" . request('search') . "%")
                    ->orWhere('bank', 'like', "%" . request('search') . "%")
                    ->orWhere('amount', 'like', "%" . request('search') . "%")
                    ->orWhere('date', 'like', "%" . request('search') . "%")
                    ->orWhere('status', 'like', "%" . request('search') . "%")
                    ;
                 
                }
               
                

                
            }, true)
            ->addColumn('transaction_id', function ($row) {

                $actionBtn = '<a class="text-dark" onclick="TransactionDetails(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
                ' . $row->transaction_id . '
            </a>';
                return $actionBtn;
            })
            ->addColumn('amount', function ($row) {
                $actionBtn = ' <div class="text-dark text-end">' . Helper::money($row->amount) . '</div>
           
           ';
                return $actionBtn;
            })

            ->addColumn('sales_reference_id', function ($row) {

                $actionBtn = '<a  onclick="TransactionDetails(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
                ' . $row->sales_reference_id . '
            </a>
           ';
                return $actionBtn;
            })
            ->addColumn('name', function ($row) {
                $actionBtn = ' <a  href="#" class="text-primary">' . $row->name . '</a>
           
           ';
                return $actionBtn;
            })

            
            ->addColumn('reconsile', function ($row) {
                if($row->reconsile ==1){
                    $actionBtn = ' <a href="#" class="text-primary">Reconciled </a>';
                }else{
                    $actionBtn = ' <a href="#" class="text-primary">PENDING </a>';
                }
               
                return $actionBtn;
            })
            ->addColumn('created_at', function ($row) {
                $created_at = $row->created_at->format('Y.m.d H:i:s');
                return $created_at;
            })
            ->addColumn('status', function ($row) {
                if($row->status =='PENDING'){
                    $actionBtn = ' <a href="" class="text-dark">' . $row->status . '</a>
           
                    ';
                         return $actionBtn;
                }else{
                    return $row->status;
                }
               
            })
            ->rawColumns(['transaction_id','sales_reference_id','amount', 'name','reconsile','status'])
            ->make(true);

          
                
               
               
             
              
        }

        
    

}
}