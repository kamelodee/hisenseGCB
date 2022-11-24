<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Showroom;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Services\Banks\CalBank;
use App\Services\Banks\Uba;
use App\Services\Banks\Gcb;
use App\Services\Banks\Zenith;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Services\Helper;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $showrooms = Showroom::all();
        return view('payment/index',compact('showrooms'));
    }

    public function transaction()
    {
        return view('payment/transaction');
    }
    public function uba()
    {
        return view('payment/uba');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reconsile(Request $request)
    {
        if(Auth::user()->can('Access All')){
       $data = Transaction::whereIn('id', $request->id)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->get();
            foreach( $data as $d){
            if($d->reconsile ==1){
                $d->update([
                    'reconsile' =>  0,
                ]);
            }else{
                $d->update([
                    'reconsile' =>  1,
                ]);
            }
            }
        
      
     return back();
    }else{
        Transaction::whereIn('id', $request->id)->whereIn('status', ['SUCCESS','SUCCESSFUL'])
        ->update([
            'reconsile' =>  1,
        ]);
        return back();
     }

    }
    public function reconsileweek(Request $request)
    {
        $currentDate = Carbon::now();
        $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
        $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
        if(Auth::user()->can('Access All')){
       $data = Transaction::whereBetween('created_at', [$nowDate, $nextweekdate])->whereIn('status', ['SUCCESS','SUCCESSFUL'])->get();
            foreach( $data as $d){
            if($d->reconsile ==1){
                $d->update([
                    'reconsile' =>  0,
                ]);
            }else{
                $d->update([
                    'reconsile' =>  1,
                ]);
            }
            }
        
      
     return back();
    }else{
        Transaction::whereBetween('created_at', [$nowDate, $nextweekdate])->whereIn('status', ['SUCCESS','SUCCESSFUL'])
        ->update([
            'reconsile' =>  1,
        ]);
        return back();
     }

    }
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       
    }
    public function processing(Request $request)
    {
        $token= request()->paytoken;
       $data = CalBank::getTransactions($token);
        //  return json_decode($data->return);
       if (json_decode($data->return)->CODE == 1) {
        
           return back()->with('error', json_decode($data->return)->MESSAGE);
       } else {
           if (json_decode($data->return)->RESULT[0]->FINALSTATUS == 'SUCCESS') {
             $transaction =  Transaction::where('transaction_id',$token)->first();
             if($transaction){
                $transaction ->update(['status' => json_decode($data->return)->RESULT[0]->FINALSTATUS]);
                return redirect()->route('transactions')->with('success', 'Payment successfully.');
            }else{
                return redirect()->route('transactions')->with('error', 'Payment Failed.'); 
            }
            
            
            }else if(json_decode($data->return)->RESULT[0]->FINALSTATUS == 'FAILED'){
                
                Transaction::where('transaction_id',$token)->first()->update(['status' => json_decode($data->return)->RESULT[0]->FINALSTATUS]);
                return redirect()->route('transactions')->with('error', 'Payment Failed.'); 
            }else{
                return view('payment/processing'); 
            }
       }
        return view('payment/processing');
       
    }


    // calpay function
    public function calpay(Request $request)
    {
        $roles = Auth::user()->getRoleNames();
        
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'order_code' => 'required',
            'phone' => 'required',


        ]);
        $trans = Transaction::latest()->first();
        $showroom = Showroom::where('name', Auth::user()->can('Access All')?$request->showroom:Auth::user()->showroom)->first();

        $data = CalBank::pay($request->amount, $request->phone, $request->name, $request->order_code, $showroom->city ? $showroom->city : "", $trans->id);
        $transid= Helper::username($trans->id,$trans->customer_name);
        // return json_decode($data->return);
        if (json_decode($data->return)->SUCCESS == false) {
            return back()->with('error', json_decode($data->return)->MESSAGE);
        } else {
            $transaction =   Transaction::create([
                'customer_name' => $request->name,
                'showroom' => $showroom->name,
                'order_code' => json_decode($data->return)->RESULT[0]->ORDERCODE,
                'payment_token' => json_decode($data->return)->RESULT[0]->PAYMENTTOKEN,
                'payment_code' => json_decode($data->return)->RESULT[0]->PAYMENTCODE,
                'shortpay_code' => json_decode($data->return)->RESULT[0]->SHORTPAYCODE,
                'transaction_id' => json_decode($data->return)->RESULT[0]->PAYMENTTOKEN,
                'transaction_type' => json_decode($data->return)->RESULT[0]->DESCRIPTION,
                'ref' => json_decode($data->return)->RESULT[0]->DESCRIPTION,
                'phone' => $request->phone,
                'amount' => $request->amount,
                'sales_reference_id' => $transid,
                'account_number' => $request->phone,
                'status' => 'PENDING',
                'bank' => 'CALBANK',
                'description' => json_decode($data->return)->RESULT[0]->DESCRIPTION,
                'date' => date('Y.m.d H:i:s'),
            ]);
            if ($transaction) {
                Activity::activityCreate('App\Models\Transaction','Transaction created',$transaction->id);
                 return redirect(json_decode($data->return)->RESULT[0]->APIPAYREDIRECTURL);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
