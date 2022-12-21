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
            $trans = Transaction::where('showroom',$showroom)->where('transaction_type',$transaction_type)->whereBetween('created_at', array($date1, $date2))->get();

        }

        if(empty($date1) && !empty($transaction_type) && empty($period) && empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->where('transaction_type',$transaction_type)->get();

        }
        if(empty($date1) && empty($transaction_type) && empty($period) && empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->get();

        }

        if(!empty($date1) && empty($transaction_type) && empty($period) && empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->whereBetween('created_at', array($date1, $date2))->get();

        }
        if(!empty($date1) && empty($transaction_type) && empty($period) && empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->whereBetween('created_at', array($date1, $date2))->get();

        }
        if(!empty($date1) && empty($transaction_type) && empty($period) && !empty($bank)){
            
            $trans = Transaction::where('showroom',$showroom)->where('bank',$bank)->whereBetween('created_at', array($date1, $date2))->get();

        }
        if(!empty($date1) && empty($transaction_type) && empty($period) && !empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->where('bank',$bank)->whereBetween('created_at', array($date1, $date2))->get();

        }
        if(empty($date1) && empty($transaction_type) && empty($period) && !empty($bank)){
          
            $trans = Transaction::where('bank',$bank)->where('showroom',$showroom)->get();

        

        if(empty($date1) && !empty($transaction_type) && empty($period) && !empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->where('transaction_type',$transaction_type)->where('bank',$bank)->get();

        }
       
        if( $period =='week' && empty($bank)){
            $currentDate = Carbon::now();
            $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
            $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
             
        $trans = Transaction::where('showroom',$showroom)->whereBetween('created_at', [$nowDate, $nextweekdate])->get();
      
        }
        if( $period =='week' && !empty($bank)){
            $currentDate = Carbon::now();
            $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
            $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
             
        $trans = Transaction::where('bank',$bank)->where('showroom',$showroom)->whereBetween('created_at', [$nowDate, $nextweekdate])->get();
      
        }
        if($period =='month' && empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->whereMonth('created_at', Carbon::now()->month)->get();

        }
        if($period =='month' && !empty($bank)){
            $trans = Transaction::where('bank',$bank)->where('showroom',$showroom)->whereMonth('created_at', Carbon::now()->month)->get();

        }
        if($period =='year' && empty($bank)){
            
            $trans = Transaction::where('showroom',$showroom)->whereYear( 'created_at', Carbon::now()->year)->get();
 
         }
        if($period =='year' && !empty($bank)){
            
            $trans = Transaction::where('bank',$bank)->where('showroom',$showroom)->whereYear( 'created_at', Carbon::now()->year)->get();
 
         }
         if($period =='today' && empty($bank)){
            $trans = Transaction::where('showroom',$showroom)->whereDay('created_at',Carbon::now())->get();

        }
         if($period =='today' && !empty($bank)){
            $trans = Transaction::where('bank',$bank)->where('showroom',$showroom)->whereDay('created_at',Carbon::now())->get();

        }

       
       }

       if(empty($showroom)){
        // no show room
        
        if(!empty($date1)  && !empty($transaction_type) && empty($period) && empty($bank)){
           
            $trans = Transaction::where('transaction_type',$transaction_type)->whereBetween('created_at', array($date1, $date2))->get();

        }

        if(!empty($transaction_type) && empty($period) && empty($date1) && empty($bank)){
            $trans = Transaction::where('transaction_type',$transaction_type)->get();

        }

        if(!empty($date1) && empty($period) && empty($transaction_type) && empty($bank)){
            $trans = Transaction::whereBetween('created_at', array($date1, $date2))->get();

        }
        if(!empty($date1) && empty($period) && empty($transaction_type) && !empty($bank)){
            $trans = Transaction::whereBetween('created_at', array($date1, $date2))->where('bank',$bank)->get();

        }
        if(!empty($date1) && empty($period) && !empty($transaction_type) && !empty($bank)){
            $trans = Transaction::whereBetween('created_at', array($date1, $date2))->where('bank',$bank)->where('transaction_type',$transaction_type)->get();

        }
        if(empty($date1) && empty($period) && !empty($transaction_type) && !empty($bank)){
            $trans = Transaction::where('bank',$bank)->where('transaction_type',$transaction_type)->get();

        }
        if(empty($date1) && empty($period) && empty($transaction_type) && !empty($bank)){
            $trans = Transaction::where('bank',$bank)->get();

        }
        if(empty($date1) && empty($period) && empty($transaction_type) && empty($bank)){
            $trans = Transaction::get();

        }
        if($period =='week' && empty($bank)){
            $currentDate = Carbon::now();
            $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
            $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
             
        $trans = Transaction::whereBetween('created_at', [$nowDate, $nextweekdate])->get();
      
        }
        if($period =='week' && !empty($bank)){
            $currentDate = Carbon::now();
            $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
            $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
             
           $trans = Transaction::where('bank',$bank)->whereBetween('created_at', [$nowDate, $nextweekdate])->get();
      
        }

        if($period =='month' && empty($bank)){
            $trans = Transaction::whereMonth('created_at', Carbon::now()->month)->get();

        }
        if($period =='month' && !empty($bank)){
            $trans = Transaction::where('bank',$bank)->whereMonth('created_at', Carbon::now()->month)->get();

        }
        if($period =='year' && empty($bank)){
         
            $trans = Transaction::whereYear( 'created_at', Carbon::now()->year)->get();

        }
        if($period =='today' && empty($bank)){
            $trans = Transaction::whereDay('created_at',Carbon::now())->get();

        }
        if($period =='today' && !empty($bank)){
            $trans = Transaction::where('bank',$bank)->whereDay('created_at',Carbon::now())->get();

        }
        
       
       }
    
         return self::transist($request,$trans);

           }
        }

    public static function transist( $request,$trans)
    {
        $data = $trans->get();
        if (request()->has('search')) {

              
          $data =  $trans= $trans->where(function ($q) {
                $q->orWhere('ref', 'like', "%" . request('search') . "%")
                ->orWhere('showroom', 'like', "%" . request('search') . "%")
                ->orWhere('date', 'like', "%" . request('search') . "%")
                ->orWhere('transaction_type', 'like', "%" . request('search') . "%")
                ->orWhere('phone', 'like', "%" . request('search') . "%")
                ->orWhere('customer_name', 'like', "%" . request('search') . "%")
                ;
            })->get();
            
           
         }



        if($request->ajax()){
            if($trans){
            // return $trans;
            return DataTables::of($data)
           
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
                $actionBtn = ' <a  href="#" class="text-primary">' . $row->id . '</a>
           
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
}