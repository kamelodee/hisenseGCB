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
        $showroom = Showroom::where('name', Auth::user()->can('Access All')?$request->showroom:Auth::user()->showroom)->first();

       $data = Uba::pay($request->name,$request->phone,$request->amount,$request->order_code);
       
        $transid= Helper::username($trans->id,$trans->customer_name);
      return json_decode($data);
        if (json_decode($data)->status != 0) {
            return back()->with('error', json_decode($data)->response);
        } else {
            $transaction =   Transaction::create([
                'customer_name' => $request->name,
                'showroom' => $showroom->name,
                'order_code' => json_decode($data)->Response->unique_value,
                'payment_token' => json_decode($data)->Response->unique_value,
                'payment_code' => json_decode($data)->Response->approval_code,
                'shortpay_code' => json_decode($data)->Response->unique_value,
                'transaction_id' => json_decode($data)->Response->transaction_id,
                'transaction_type' =>json_decode($data)->Response->description,
                'ref' => json_decode($data)->Response->reference_no,
                'phone' => $request->phone,
                'amount' => $request->amount,
                'sales_reference_id' => $transid,
                'account_number' => $request->phone,
                'status' => 'PENDING',
                'bank' => 'CALBANK',
                'description' => json_decode($data)->Response->description,
                'date' => date('Y.m.d H:i:s'),
            ]);
            if ($transaction) {
                Activity::create(['user_id'=>Auth::user()->id,'user_name'=>Auth::user()->name,'showroom'=>Auth::user()->showroom,'description'=>"Transaction created",'model_id'=>$transaction->id,'model_name'=>'App\Models\Transaction']);
                return back();
            }
        }
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
