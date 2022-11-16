<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Banks\Uba;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use App\Services\Helper;
use App\Models\Activity;
use App\Models\Showroom;
class UBAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function returnoute(Request $request)
    {
        // dd($request->Ref);
       $data = Uba::getTransaction(request()->Ref);

     
       
       $showroom = Showroom::where('name', Auth::user()->can('Access All')?$request->showroom:Auth::user()->showroom)->first();
      $trans = Transaction::where('order_code',json_decode($data)->Response->unique_value)->first();
       
    //    return json_decode($data);
         if (json_decode($data)->Response->status =='CANCELED') {
            $transaction =   $trans->update([
                'transaction_id' => json_decode($data)->Response->transaction_id,
                'transaction_type' =>json_decode($data)->Response->description,
                'ref' => json_decode($data)->Response->reference_no,
                'amount' => json_decode($data)->Response->amount,
                'status' => json_decode($data)->Response->status,
                'bank_ref' => request()->Ref,
                'description' => json_decode($data)->Response->description,
            ]);
            Activity::activityCreate('App\Models\Transaction','Transaction Failed',$trans->id);
            
            return redirect()->route('transactions.uba')->with('error', json_decode($data)->Response->info);

         } else {
             $transaction =   $trans->update([
                 'payment_token' => json_decode($data)->Response->unique_value,
                 'payment_code' => json_decode($data)->Response->approval_code,
                 'shortpay_code' => json_decode($data)->Response->unique_value,
                 'transaction_id' => json_decode($data)->Response->transaction_id,
                 'transaction_type' =>json_decode($data)->Response->description,
                 'ref' => json_decode($data)->Response->reference_no,
                 'amount' => json_decode($data)->Response->amount,
                 'status' => json_decode($data)->Response->status,
                 'bank_ref' => request()->Ref,
                 'description' => json_decode($data)->Response->description,
             ]);
             if ($transaction) {
                Activity::activityCreate('App\Models\Transaction','Transaction created',$transaction->id);
                 return redirect()->route('transactions.uba')->with('success', 'Transaction successfully.');;
             }
         }
    }
    public function updatetransaction($ref)
    {
        // dd($request->Ref);
       $data = Uba::getTransaction($ref);

     
       $trans = Transaction::latest()->first();
       
       $transid= Helper::username($trans->id,$trans->customer_name);
    //    return json_decode($data);
         if (json_decode($data)->Status != 0) {
             return back()->with('error', json_decode($data)->response);
         } else {
             $transaction =   Transaction::find()->update([
                 'customer_name' => json_decode($data)->Response->unique_value,
                 'showroom' => Auth::user()->showroom,
                 'order_code' => json_decode($data)->Response->unique_value,
                 'payment_token' => json_decode($data)->Response->unique_value,
                 'payment_code' => json_decode($data)->Response->approval_code,
                 'shortpay_code' => json_decode($data)->Response->unique_value,
                 'transaction_id' => json_decode($data)->Response->transaction_id,
                 'transaction_type' =>json_decode($data)->Response->description,
                 'ref' => json_decode($data)->Response->reference_no,
                 'phone' => json_decode($data)->Response->unique_value,
                 'amount' => json_decode($data)->Response->amount,
                 'sales_reference_id' => $transid,
                 'account_number' => json_decode($data)->Response->unique_value,
                 'status' => json_decode($data)->Response->status,
                 'bank' => 'UBA',
                 'description' => json_decode($data)->Response->description,
                 
             ]);
             if ($transaction) {
                        return redirect()->route('transactions.uba')->with('success', 'Transaction successfully.');;
             }
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request)
    {
       
        
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'order_code' => 'required',
            'phone' => 'required',


        ]);
        // return $request->all();
        $trans = Transaction::latest()->first();
        $transid= Helper::username($trans->id,$trans->customer_name);
        Transaction::updateOrCreate([
            'customer_name' => $request->name,
            'showroom' => Auth::user()->showroom,
            'order_code' => $request->order_code,
            'payment_token' => '',
            'payment_code' => '',
            'shortpay_code' => '',
            'transaction_id' => '',
            'transaction_type' =>'',
            'ref' => '',
            'phone' => $request->phone,
            'amount' => $request->amount,
            'sales_reference_id' => $transid,
            'account_number' => $request->phone,
            'status' => 'PENDING',
            'bank' => 'UBA',
            'description' => '',
            'date' => date('Y.m.d H:i:s'),
        ]);
// return $request->all();
       
       return Uba::pay($request->name,$request->phone,$request->amount,$request->order_code);
       
       
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
