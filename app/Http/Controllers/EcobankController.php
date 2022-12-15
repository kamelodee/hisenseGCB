<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Banks\EcoBank;
use App\Models\Activity;
use App\Models\Transaction;
use App\Services\Helper;
use Illuminate\Support\Facades\Auth;
class EcobankController extends Controller
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
    public function success(Request $request)
    {
        return $request->all();
    }

    public function canceled(Request $request)
    {
        
        return $request->all();
    
    }





    public function pay(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'order_code' => ['required', 'string'],
            'phone' => 'required',
            'amount' => 'required',
      
        ]);
     

        $trans = Transaction::latest()->first();
        
        $transid= Helper::username($trans?$trans->id+1:1,$request->name);
        $transaction= Transaction::updateOrCreate([
            'customer_name' => $request->name,
            'showroom' => Auth::user()->can('Access All')? $request->showroom: Auth::user()->showroom,
            'order_code' => $request->order_code,
            'payment_token' => '',
            'payment_code' => '',
            'shortpay_code' => '',
            'transaction_id' => '',
            'transaction_type' =>'',
            'ref' => '',
            'phone' => $request->phone,
            'amount' => $request->amount,
            'sales_reference_id' =>$request->order_code,
            'account_number' => $request->phone,
            'status' => 'PENDING',
            'bank' => 'ECOBANK',
            'description' => '',
            'date' => date('Y.m.d H:i:s'),
        ]);
        if ($transaction) {
            Activity::activityCreate('App\Models\Transaction','Transaction created',$transaction->id);
            $data=  EcoBank::pay($request->name,$request->phone,$request->amount,$request->order_code);
          
           if (json_decode($data)->status == false) {
            return back()->with('error', json_decode($data)->MESSAGE);
        } else {
            return redirect(json_decode($data)->url);
        }
            return redirect(env('ZENITH_REDIRECT_URL'));
   
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
