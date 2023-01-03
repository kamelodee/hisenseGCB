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

    
    public function refresh($ref)
    {
        $trans = Transaction::where('ref', $ref)->first();
        if ($trans) {
           $data =  Ecobank::getTransaction($ref);

          $t = json_decode($data)->{$ref};
          if($t){
            // return $t ;
            if($t->success ){
              if($t->status =='failed'){
               
                if ($t->extra->card_type == 'visa'|| $t->extra->card_type == 'mastercard' ||$t->extra->card_type ==  'visa_mastercard') {
                    
                    Transaction::where('ref', $ref)->update(['status' => "FAILED", 'transaction_type' => 'CARD',]);
                    return redirect('dashboard')->with('success', 'Payment  failed.');;
                } else {
                    Transaction::where('ref', $ref)->update(['status' => "FAILED", 'transaction_type' => 'MOMO',]);
                    return redirect('dashboard')->with('success', 'Payment failed');
                }
            }else{

                if ($t->extra->card_type == 'visa'|| $t->extra->card_type == 'mastercard' || $t->extra->card_type ==  'visa_mastercard') {
                    Transaction::where('ref', $ref)->update(['status' => "SUCCESS", 'transaction_type' => 'CARD',]);
                } else {
                    Transaction::where('ref', $ref)->update(['status' => "SUCCESS", 'transaction_type' => 'MOMO',]);
                }
            }
                }else{
                    Transaction::where('ref', $ref)->update(['status' => "FAILED"]);
             
                }
          }
        } else {

     return redirect('dashboard')->with('success', 'Payment not foung.');
        }
        return redirect('dashboard')->with('success', 'Payment made successfully.');;
    }


    public function success(Request $request)
    {

        $trans = Transaction::where('ref', $request->ref)->first();
        if ($trans) {
            $data =  Ecobank::getTransaction($request->ref);

            $t = json_decode($data)->{$request->ref};
            if ($t->extra->card_type == 'visa'|| $t->extra->card_type == 'mastercard' || $t->extra->card_type ==  'visa_mastercard') {
                Transaction::where('ref', $request->ref)->update(['status' => "SUCCESS", 'transaction_type' => 'CARD',]);
            } else {
                Transaction::where('ref', $request->ref)->update(['status' => "SUCCESS", 'transaction_type' => 'MOMO',]);
            }
        } else {

            return redirect('dashboard')->with('error', 'Payment not foung.');
        }
        return redirect('dashboard')->with('success', 'Payment made successfully.');
    }



    public function canceled(Request $request)
    {
        $trans = Transaction::where('ref', $request->ref)->first();
        if ($trans) {
           $data =  Ecobank::getTransaction($request->ref);

            $t = json_decode($data)->{$request->ref};
            if ($t->extra->card_type == 'visa'|| $t->extra->card_type == 'mastercard') {
                Transaction::where('ref', $request->ref)->update(['status' => "FAILED", 'transaction_type' => 'CARD',]);
            } else {
                Transaction::where('ref', $request->ref)->update(['status' => "FAILED", 'transaction_type' => 'MOMO',]);
            }
        }
       

        return redirect('dashboard')->with('success', 'Payment Failed.');;
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

        $transid = Helper::username($trans ? $trans->id + 1 : 1, $request->name);
        $transaction = Transaction::updateOrCreate([
            'customer_name' => $request->name,
            'showroom' => Auth::user()->can('Access All') ? $request->showroom : Auth::user()->showroom,
            'order_code' => $request->order_code,
            'payment_token' => $request->order_code,
            'payment_code' => $request->order_code,
            'shortpay_code' => $request->order_code,
            'transaction_id' => $request->order_code,
            'transaction_type' => '',
            'ref' => $request->order_code,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'sales_reference_id' => $request->order_code,
            'account_number' => $request->phone,
            'status' => 'PENDING',
            'bank' => 'ECOBANK',
            'description' => '',
            'date' => date('Y.m.d H:i:s'),
        ]);
        if ($transaction) {
            Activity::activityCreate('App\Models\Transaction', 'Transaction created', $transaction->id);
            $data =  EcoBank::pay($request->name, $request->phone, $request->amount, $request->order_code);

            if (json_decode($data)->status == false) {
                return back()->with('error', json_decode($data)->MESSAGE);
            } else {
                return redirect(json_decode($data)->url);
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
