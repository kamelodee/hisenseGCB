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
    {if($request->ref){
      return  Zenith::redirectPay($request->ref);
    }
        
    }
    public function pay(Request $request)
    {
      
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'order_code' => 'required',
            'phone' => 'required',
            'amount' => 'required',


        ]);

     $transId=  Zenith::pay($request->amount,$request->order_code,$request->order_code,$request->phone);
    return redirect('https://aspd.zenithbank.com.gh/globalpayapiV2/Service/PaySecure?gpid=GPZEN098&tid='.$transId.'');
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
