<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Bank;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use App\Services\Banks\CalBank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\Helper;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if(Auth::user()->can('Access All')){
            $activities =Activity::activities('App\Models\Transaction');
      
        $total = Helper::money(Transaction::transations('CALBANK'));
        return view('transactions/index',compact('total','activities'));
    }else{
        $activities =Activity::activities('App\Models\Transaction');
        $total = Helper::money(Transaction::cashiertransation('CALBANK'));
        return view('transactions/index',compact('total','activities'));
    }
       
        //
    }


    public function trans()
    { 
        if(Auth::user()->can('Access All')){
            $activities =Activity::activities('App\Models\Transaction');
      
        $total = Helper::money(Transaction::transations('CALBANK'));
        return view('transactions/trans',compact('total','activities'));
    }else{
        $activities =Activity::activities('App\Models\Transaction');
        $total = Helper::money(Transaction::cashiertransation('CALBANK'));
        return view('transactions/trans',compact('total','activities'));
    }
       
        //
    }
    public function gcb()
    {
        if(Auth::user()->can('Access All')){
            $activities =Activity::activities('App\Models\Transaction');
      
        $total = Helper::money(Transaction::transations('GCB'));
        return view('transactions/gcb',compact('total','activities'));
    }else{
        $activities =Activity::activities('App\Models\Transaction');
        $total = Helper::money(Transaction::cashiertransation('GCB'));
        return view('transactions/gcb',compact('total','activities'));
    }
        //
    }

    public function uba()
    {
        if(Auth::user()->can('Access All')){
            $activities =Activity::activities('App\Models\Transaction');
       
        $total = Helper::money(Transaction::transationsu('UBA'));
        return view('transactions/uba',compact('total','activities'));
        }else{
            $activities =Activity::activities('App\Models\Transaction');
            $total = Helper::money(Transaction::cashiertransation('UBA'));
            return view('transactions/uba',compact('total','activities'));
        }
        //
    }
    public function zenith()
    {
     
        if(Auth::user()->can('Access All')){
            $activities =Activity::activities('App\Models\Transaction'); 
            $total = Helper::money(Transaction::transations('ZENITH'));
        return view('transactions/zenith',compact('total','activities'));

        }else{
            $activities =Activity::activities('App\Models\Transaction');  
            $total = Helper::money(Transaction::cashiertransation('ZENITH'));
        return view('transactions/zenith',compact('total','activities'));
        }
        //
    }


    public function callist(Request $request)
    {

        if(Auth::user()->can('Access All')){
            if(!empty($request->date1)){
                return Helper::datatable($showroom='',$date1=$request->date1,$date2=$request->date2,$transaction_type='',$period='',$bank='CALBANK',request());
        
            }else{
                return Helper::datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='',$bank='CALBANK',request());
        
            }
        }else{
            if(!empty($request->date1)){
                return Helper::datatable($showroom=Auth::user()->showroom,$date1=$request->date1,$date2=$request->date2,$transaction_type='',$period='',$bank='CALBANK',request());
        
            }else{
                return Helper::datatable($showroom=Auth::user()->showroom,$date1='',$date2='',$transaction_type='',$period='',$bank='CALBANK',request());
        
            }
        }
       

        
        
    }

    public function transist(Request $request)
    {
        if(Auth::user()->can('Access All')){
            if(!empty($request->date1)){
                return Helper::datatable($showroom='',$date1=$request->date1,$date2=$request->date2,$transaction_type='',$period='',$bank='CALBANK',request());
        
            }else{
                return Helper::datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='',$bank='CALBANK',request());
        
            }
        }else{
            if(!empty($request->date1)){
                return Helper::datatable($showroom=Auth::user()->showroom,$date1=$request->date1,$date2=$request->date2,$transaction_type='',$period='',$bank='CALBANK',request());
        
            }else{
                return Helper::datatable($showroom=Auth::user()->showroom,$date1='',$date2='',$transaction_type='',$period='',$bank='CALBANK',request());
        
            }
        }
       
       
        
    }

    public function zenithlist(Request $request)
    {
        $bank = Bank::where('status',"ACTIVE")->first()->name;
        if(Auth::user()->can('All Transaction')){
            if(!empty($request->date1)){
                $trans= Transaction::where('bank',$bank)->whereBetween('created_at', array($request->date1, $request->date2))->orderBy('created_at', 'desc');
                return Helper::transist($request,$trans);
          
            }else{
                $trans= Transaction::where('bank',$bank)->orderBy('created_at', 'desc');
                return Helper::transist($request,$trans);
          
            }
        }else{
            if(!empty($request->date1)){
                $trans= Transaction::where('bank',$bank)->where('showroom',Auth::user()->showroom)->whereBetween('created_at', array($request->date1, $request->date2))->orderBy('created_at', 'desc');
                return Helper::transist($request,$trans);
          
            }else{
                $trans= Transaction::where('bank',$bank)->where('showroom',Auth::user()->showroom)->orderBy('created_at', 'desc');
                return Helper::transist($request,$trans);
          
            }
        }
        

        
    }
    public function ubalist(Request $request)
    {
        if(Auth::user()->can('Access All')){
            if(!empty($request->date1)){
                return Helper::datatable($showroom='',$date1=$request->date1,$date2=$request->date2,$transaction_type='',$period='',$bank='UBA',request());
        
            }else{
                return Helper::datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='',$bank='UBA',request());
        
            }
        }else{
            if(!empty($request->date1)){
                return Helper::datatable($showroom=Auth::user()->showroom,$date1=$request->date1,$date2=$request->date2,$transaction_type='',$period='',$bank='UBA',request());
        
            }else{
                return Helper::datatable($showroom=Auth::user()->showroom,$date1='',$date2='',$transaction_type='',$period='',$bank='UBA',request());
        
            }
        }
        

        
    }
    public function gcblist(Request $request,$bank)
    {
        if(Auth::user()->can('Access All')){
            if(!empty($request->date1)){
                $trans= Transaction::where('bank',$bank)->orderBy('created_at', 'desc');
             
                return Helper::transist($request,$trans);
            }else{
                $trans= Transaction::where('bank',$bank)->orderBy('created_at', 'desc');
             
                return Helper::transist($request,$trans);
            }
        }else{
            if(!empty($request->date1)){
                $trans= Transaction::where('showroom',Auth::user()->showroom)->where('bank',$bank)->orderBy('created_at', 'desc');
             
                return Helper::transist($request,$trans);
            }else{
                $trans= Transaction::where('showroom',Auth::user()->showroom)->where('bank',$bank)->orderBy('created_at', 'desc');
             
                return Helper::transist($request,$trans);
            }
        }

       

        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required',

        ]);
        Transaction::updateOrCreate($request->all());
        return back();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function load()
    {
        $transaction = Transaction::where('status', 'PENDING')->where('showroom', Auth::user()->showroom)->where('bank','CALBANK')->get();
        foreach ($transaction as $trans) {

            $data = CalBank::getTransactions($trans->transaction_id);

            if (json_decode($data->return)->CODE == 1) {
                return back()->with('error', json_decode($data->return)->MESSAGE);
            } else {
                if (json_decode($data->return)->RESULT[0]->FINALSTATUS != 'PENDING') {
                    Transaction::find($trans->id)->update(['status' => json_decode($data->return)->RESULT[0]->FINALSTATUS]);
                }
            }
        }
        return back();
    }

    public function show(Transaction $transaction, $id)
    {
        $transaction = Transaction::find($id);
       $amount =  Helper::money($transaction->amount);
        return view('transactions/show', compact('transaction','amount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
