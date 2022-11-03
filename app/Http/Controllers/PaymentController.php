<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Showroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Services\Banks\CalBank;
use App\Services\Banks\Uba;
use App\Services\Banks\Gcb;
use App\Services\Banks\Zenith;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payment/index');
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

       if (json_decode($data->return)->CODE == 1) {
        
           return back()->with('error', json_decode($data->return)->MESSAGE);
       } else {
           if (json_decode($data->return)->RESULT[0]->FINALSTATUS == 'SUCCESS') {
               Transaction::where('transaction_id',$token)->first()->update(['status' => json_decode($data->return)->RESULT[0]->FINALSTATUS]);
             return redirect()->route('transactions')->with('success', 'Payment successfully.');
            }else if(json_decode($data->return)->RESULT[0]->FINALSTATUS == 'FAILED'){
                
                Transaction::where('transaction_id',$token)->first()->update(['status' => json_decode($data->return)->RESULT[0]->FINALSTATUS]);
                return redirect()->route('transactions')->with('error', 'Payment Failed.'); 
            }else{
                return view('payment/processing'); 
            }
       }
        return view('payment/processing');
       
    }


    public function calpay(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'order_code' => 'required',
            'phone' => 'required',


        ]);

        $showroom = Showroom::where('name', Auth::user()->showroom)->first();

        $data = CalBank::pay($request->amount, $request->phone, $request->name, $request->order_code, $showroom->city ? $showroom->city : "");

        if (json_decode($data->return)->CODE == 1) {
            return back()->with('error', json_decode($data->return)->MESSAGE);
        } else {
            $transaction =   Transaction::create([
                'customer_name' => $request->name,
                'showroom' => Auth::user()->showroom,
                'order_code' => json_decode($data->return)->RESULT[0]->ORDERCODE,
                'payment_token' => json_decode($data->return)->RESULT[0]->PAYMENTTOKEN,
                'payment_code' => json_decode($data->return)->RESULT[0]->PAYMENTCODE,
                'shortpay_code' => json_decode($data->return)->RESULT[0]->SHORTPAYCODE,
                'transaction_id' => json_decode($data->return)->RESULT[0]->PAYMENTTOKEN,
                'transaction_type' => json_decode($data->return)->RESULT[0]->DESCRIPTION,
                'ref' => json_decode($data->return)->RESULT[0]->DESCRIPTION,
                'phone' => $request->phone,
                'amount' => $request->amount,
                'account_number' => $request->phone,
                'status' => 'PENDING',
                'bank' => 'CALBANK',
                'description' => json_decode($data->return)->RESULT[0]->DESCRIPTION,
                'date' => date('Y.m.d H:i:s'),
            ]);
            if ($transaction) {
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
