<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Banks\Zenith;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Showroom;
use App\Models\Activity;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Services\Banks\CalBank;
use App\Services\Banks\Uba;
use App\Services\Banks\Gcb;

use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Services\Helper;

class ZenithController extends Controller
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


    public function redirect(Request $request)
    {
        
        
        if($request->ref){
      $data =  Zenith::getTransaction($request->ref);
      $trans = Transaction::latest()->first();
      $showroom = Showroom::where('name', Auth::user()->showroom)->first();
      $transid= Helper::username($trans?$trans->id+1:1,$request->name);
    //   return json_decode($data)->amount;
      if (json_decode($data)->status == false) {
          return back()->with('error', json_decode($data)->MESSAGE);
      } else {
        // dd('lkkk');
          $transaction =   Transaction::create([
        
              'order_code' => json_decode($data)->productID,
              'payment_token' => json_decode($data)->refID,
              'payment_code' => json_decode($data)->refID,
              'shortpay_code' => json_decode($data)->refID,
              'transaction_id' => $transid,
              'transaction_type' => json_decode($data)->type,
              'ref' => json_decode($data)->refID,
              'amount' => json_decode($data)->amount,
              'sales_reference_id' => json_decode($data)->productID,
              'account_number' => json_decode($data)->pan,
              'status' => 'PENDING',
              'bank' => 'ZENITH',
              'description' => json_decode($data)->description,
              'date' => date('Y.m.d H:i:s'),
          ]);
          if ($transaction) {
              Activity::activityCreate('App\Models\Transaction','Transaction created',$transaction->id);
               return back();
          }
      }
    }
        
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
            'bank' => 'ZENITH',
            'description' => '',
            'date' => date('Y.m.d H:i:s'),
        ]);
        if ($transaction) {
            Activity::activityCreate('App\Models\Transaction','Transaction created',$transaction->id);
            $transId=  Zenith::pay($request->amount,$request->order_code,$request->order_code,$request->phone);
            return redirect(env('ZENITH_REDIRECT_URL').'&tid='.$transId);

        }

}



    public function pay1(Request $request)
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
            'bank' => 'ZENITH',
            'description' => '',
            'date' => date('Y.m.d H:i:s'),
        ]);
        if ($transaction) {
            Activity::activityCreate('App\Models\Transaction','Transaction created',$transaction->id);
            $transId=  Zenith::pay($request->amount,$request->order_code,$request->order_code,$request->phone);
            return redirect(env('ZENITHBANKURL_TEST').'&tid='.$transId);
   
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
