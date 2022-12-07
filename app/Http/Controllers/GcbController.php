<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Exception;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TestTransaction;
use App\Services\Odoo;

use App\Models\Showroom;
use App\Models\Activity;
use App\Services\Odoo\Customer;
use App\Services\Helper;

use Ripoo\Exception\{CodingException, ResponseException, ResponseEntryException, ResponseFaultException, ResponseStatusException};

class GcbController extends Controller
{
    


    public function login(Request $request)
    {
    //    return $request->all();
       info($request->all());
        $validator = Validator::make($request->all(), [

            'showroom' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 401,
                'error' => $validator->messages()
            ], 200);
        }

        $credentials = $request->only('showroom', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('showroom', $request->showroom)->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'statusCode' => 200,
               
            ], 200);
        }else{
            return response()->json([
                'message' => "Invalid login details",
                'statusCode' => 401,
            ], 401);
        }

    }
    public function testlogin(Request $request)
    {
    //    return $request->all();
       info($request->all());
        $validator = Validator::make($request->all(), [

            'showroom' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 401,
                'error' => $validator->messages()
            ], 200);
        }

        $credentials = $request->only('showroom', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('showroom', $request->showroom)->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'statusCode' => 200,
               
            ], 200);
        }else{
            return response()->json([
                'message' => "Invalid login details",
                'statusCode' => 401,
            ], 401);
        }

    }

    
    public function deposit(Request $request)
    {
    //   return  $request->all();
      try{
        $validator = Validator::make($request->all(), [
            'showroom' => 'required',
            'customer_id' => 'required',
            'customer_name' => 'required',
            'ref' => ['required', 'string', 'unique:transactions'],
            'date' => 'required',
            'amount' => 'required',
            'transaction_type' => 'required',
            'account_number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 401,
                'error' => $validator->messages()
            ], 401);
        }


        try {
            if(Auth::user()->showroom =="Head Office"){
             
                $transa=  Transaction::where('ref',  $request->ref)->first();
                if($transa){
                    $transa->update([
                        'customer_name' => $request->customer_name,
                        'showroom' => Auth::user()->showroom,
                        'order_code' => 'gcb',
                        'payment_token' => $transa,
                        'payment_code' =>$transa,
                        'shortpay_code' => $transa,
                        'transaction_id' => $transa,
                        'transaction_type' => $request->transaction_type,
                        'ref' => $request->ref,
                        'phone' => $request->customer_id,
                        'sales_reference_id' =>$request->ref,
                        'amount' => $request->amount,
                        'account_number' => $request->account_number,
                        'status' => 'SUCCESS',
                        'bank' =>$request->bank? $request->bank: 'EOBANK',
                        'description' => "EOBANK Transaction",
                        'date' => $request->date,
                    ]);

                    return response()->json([
                        'message' => "Payment Registered",
                        'statusCode' => 200,
    
                    ], 200);
            }else{
                return response()->json([
                    'message' => "Invalid showroom",
                    'statusCode' => 401,

                ], 401); 
            }


        }
           return [$request->showroom,Auth::user()->showroom];
            $trans = Transaction::latest()->first();
           
               $transid= Helper::username($trans->id,$trans->customer_name);
               $showroom = Showroom::where('name',Auth::user()->showroom)->first();

            if(Auth::user()->showroom === $request->showroom && $showroom->account_number ==$request->account_number){
                $transa=  Transaction::where('ref',  $request->ref)->first();
                if($transa){
                    $transa->update([
                        'customer_name' => $request->customer_name,
                        'showroom' => Auth::user()->showroom,
                        'order_code' => 'gcb',
                        'payment_token' => $transid,
                        'payment_code' =>$transid,
                        'shortpay_code' => $transid,
                        'transaction_id' => $transid,
                        'transaction_type' => $request->transaction_type,
                        'ref' => $request->ref,
                        'phone' => $request->customer_id,
                        'sales_reference_id' =>$request->ref,
                        'amount' => $request->amount,
                        'account_number' => $request->account_number,
                        'status' => 'SUCCESS',
                        'bank' =>$request->bank? $request->bank: 'GCB',
                        'description' => "GCB Transaction",
                        'date' => $request->date,
                    ]);
                }
                    $transaction =   Transaction::create([
                        'customer_name' => $request->customer_name,
                        'showroom' => Auth::user()->showroom,
                        'order_code' => 'gcb',
                        'payment_token' => $transid,
                        'payment_code' =>$transid,
                        'shortpay_code' => $transid,
                        'transaction_id' => $transid,
                        'transaction_type' => $request->transaction_type,
                        'ref' => $request->ref,
                        'phone' => $request->customer_id,
                        'sales_reference_id' =>$request->ref,
                        'amount' => $request->amount,
                        'account_number' => $request->account_number,
                        'status' => 'SUCCESS',
                        'bank' =>$request->bank? $request->bank: 'GCB',
                        'description' => "GCB Transaction",
                        'date' => $request->date,
                    ]);
                 
                    if( $transaction){
                        Auth::user()->tokens->each(function($token, $key) {
                            $token->delete();
                        });
                        return response()->json([
                            'message' => "Payment Registered",
                            'statusCode' => 200,
        
                        ], 200);
                    }     
            }else{
                return response()->json([
                    'message' => "Invalid showroom",
                    'statusCode' => 401,

                ], 401);   
            } 
        } catch (ResponseException $e) {
            report($e);
         info($e);
            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
      }catch(Exception $error){
        report($error);
        info($error);
        return response()->json([
            'message' => 'something went wrong',
            'statusCode' => 500,

        ], 500);
      }
       

       
    }
    public function verify(Request $request)
    {
    //   return  $request->all();
      try{
        $validator = Validator::make($request->all(), [
           
            'ref' => 'required',
           
        ]);


        
        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 401,
                'error' => $validator->messages()
            ], 401);
        }


        try {
            // return [$request->showroom,Auth::user()->showroom];
            // $trans = Transaction::latest()->first();
           
            //    $transid= Helper::username($trans->id,$trans->customer_name);
            if(Auth::user()->showroom){
             $showroom = Showroom::where('name',$request->showroom)->first();

               
                    $transaction =   TestTransaction::where('sales_reference_id',$request->ref)->first();
                 
                    if( $transaction){
                     
                        return response()->json([
                            'message' => "success",
                            'statusCode' => 200,
                            'data'=>[
                                'amount'=>$transaction->amount,
                                'ref'=>$transaction->sales_reference_id,
                                'account'=>$transaction->account_number,
                                'showroom'=>$transaction->showroom,
                                
                            ]
        
                        ], 200);
                    }else{
                        return response()->json([
                            'message' => "No transaction",
                            'statusCode' => 404,
                            
        
                        ], 404); 
                    }     
            }else{
                return response()->json([
                    'message' => "Invalid showroom",
                    'statusCode' => 401,

                ], 401);   
            } 
        } catch (ResponseException $e) {
            report($e);
         info($e);
            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
      }catch(Exception $error){
        report($error);
        info($error);
        return response()->json([
            'message' => 'something went wrong',
            'statusCode' => 500,

        ], 500);
      }
       

       
    }



    public function testdeposit(Request $request)
    {
    //   return  $request->all();
      try{
        $validator = Validator::make($request->all(), [
            'showroom' => 'required',
            'customer_id' => 'required',
            'customer_name' => 'required',
            'ref' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'transaction_type' => 'required',
            'account_number' => 'required',
        ]);


        
        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 401,
                'error' => $validator->messages()
            ], 401);
        }


        try {
            // return [$request->showroom,Auth::user()->showroom];
            if(Auth::user()->showroom === $request->showroom){
             
                    $transaction =   TestTransaction::create([
                        'customer_name' => $request->customer_id,
                        'showroom' => Auth::user()->showroom,
                        'order_code' => 'gcb',
                        'payment_token' => sha1(md5(time())),
                        'payment_code' =>sha1(md5(time())),
                        'shortpay_code' => sha1(md5(time())),
                        'transaction_id' => sha1(md5(time())),
                        'transaction_type' => $request->transaction_type,
                        'ref' => $request->ref,
                        'phone' => $request->customer_id,
                        'amount' => $request->amount,
                        'account_number' => $request->account_number,
                        'status' => 'SUCCESS',
                        'bank' => 'GCB',
                        'description' => $request->ref,
                        'date' => $request->date,
                    ]);
                 
                    if( $transaction){
                        Auth::user()->tokens->each(function($token, $key) {
                            $token->delete();
                        });
                        return response()->json([
                            'message' => "Payment Registered",
                            'statusCode' => 200,
        
                        ], 200);
                    }     
            }else{
                return response()->json([
                    'message' => "Invalid showroom",
                    'statusCode' => 401,

                ], 401);   
            } 
        } catch (ResponseException $e) {
            report($e);
         info($e);
            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
      }catch(Exception $error){
        report($error);
        info($error);
        return response()->json([
            'message' => 'something went wrong',
            'statusCode' => 500,

        ], 500);
      }
       

       
    }

    public function ecobankdeposit(Request $request)
    {
    //   return  $request->all();
    // GPZEN2022110712244
      try{
        $validator = Validator::make($request->all(), [
            'showroom' => 'required',
            'customer_phone' => 'required',
            'customer_name' => 'required',
            'ref' => 'required',
            'sales_ref' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'transaction_type' => 'required',
            'account_number' => 'required',
        ]);


        
        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 401,
                'error' => $validator->messages()
            ], 401);
        }


        try {
            // return [$request->showroom,Auth::user()->showroom];
            if(Auth::user()->showroom === $request->showroom){
               $transaction = Transaction::where('order_code',$request->sales_ref)->first();
                 if(!$transaction){
                    return response()->json([
                        'message' => "No Transaction Entry Found",
                        'statusCode' => 404,
    
                    ], 404);
                 }
               if($transaction->amount != $request->amount){
                return response()->json([
                    'message' => "Transaction Amount Mismatched",
                    'statusCode' => 404,

                ], 404);
               }
            $branch = Customer::branch(Auth::user()->showroom);
                if (count($branch) > 0 ) {
                    $transaction =   Transaction::create([
                        'customer_name' => $request->customer_id,
                        'showroom' => Auth::user()->showroom,
                        'order_code' => 'gcb',
                        'payment_token' => sha1(md5(time())),
                        'payment_code' =>sha1(md5(time())),
                        'shortpay_code' => sha1(md5(time())),
                        'transaction_id' => sha1(md5(time())),
                        'transaction_type' => $request->transaction_type,
                        'ref' => '',
                        'phone' => $request->customer_id,
                        'amount' => $request->amount,
                        'account_number' => $request->phone,
                        'status' => 'PAID',
                        'bank' => 'GCB',
                        'description' => $request->ref,
                        'date' => $request->date,
                    ]);
                   $customer = Customer::getCustomer($request->customer_id);
                     if(count($customer)>0){
                        if($branch[0]['bank_journal_id']>0){
                            $data = [
                                'partner_id' => $customer[0]['id'],
                                'state' => 'draft',
                                'branch_id' => $branch[0]['id'],
                                'date' => $request->date,
                                'payment_type' => 'inbound',
                                'payment_method_id' => 1,
                                'company_id' => 2,
                                'amount' => $request->amount,
                                'journal_id' => $branch[0]['bank_journal_id'][0],
                                'ref' => $request->ref,
        
                            ];
                            $deposit = Customer::deposit($data);
                           }else{
                            info($branch[0]);
                            return response()->json([
                                'message' => "Someting went wrong",
                                'statusCode' => 500,
            
                            ], 500);
                           }
                  
                if($deposit){
                    Auth::user()->tokens->each(function($token, $key) {
                        $token->delete();
                    });
                    return response()->json([
                        'message' => "Payment Registered",
                        'statusCode' => 200,
    
                    ], 200);
                }
                }else{
                    $data = [
                        
                       
                        'phone' => $request->customer_id,
                        'name' => $request->customer_name,
                        'city' => $request->showroom,
                       
                    ];
                    Customer::creatCustomer($data);
                    $customer = Customer::getCustomer($request->customer_id);

                    $datac = [
                        'partner_id' => $customer[0]['id'],
                        'state' => 'draft',
                        'branch_id' => $branch[0]['id'],
                        'date' => $request->date,
                        'payment_type' => 'inbound',
                        'payment_method_id' => 1,
                        'company_id' => 2,
                        'amount' => $request->amount,
                        'journal_id' => $branch[0]['bank_journal_id'][0],
                        'ref' => $request->ref,

                    ];

                    $deposit = Customer::deposit($datac);
                if($deposit){
                    Auth::user()->tokens->each(function($token, $key) {
                        $token->delete();
                    });
                    return response()->json([
                        'message' => "Payment Registered",
                        'statusCode' => 200,
    
                    ], 200);
                }
                }
                }else{
                    info($branch);
                    // return $branch;
                    return response()->json([
                        'message' => "No showroom",
                        'statusCode' => 401,
    
                    ], 401);  
                }
                
            }else{
                return response()->json([
                    'message' => "Invalid showroom",
                    'statusCode' => 401,

                ], 401);   
            } 
        } catch (ResponseException $e) {
            report($e);
         info($e);
            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
      }catch(Exception $error){
        report($error);
        info($error);
        return response()->json([
            'message' => 'something went wrong',
            'statusCode' => 500,

        ], 500);
      }
       

       
    }



    public function deposit1(Request $request)
    {
    //   return  $request->all();
      try{
        $validator = Validator::make($request->all(), [
            'showroom' => 'required',
            'customer_id' => 'required',
            'customer_name' => 'required',
            'ref' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'transaction_type' => 'required',
            'account_number' => 'required',
        ]);


        
        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 401,
                'error' => $validator->messages()
            ], 401);
        }


        try {
            // return [$request->showroom,Auth::user()->showroom];
            if(Auth::user()->showroom === $request->showroom){
               
            $branch = Customer::branch(Auth::user()->showroom);
                if (count($branch) > 0 ) {
                    $transaction =   Transaction::create([
                        'customer_name' => $request->customer_id,
                        'showroom' => Auth::user()->showroom,
                        'order_code' => 'gcb',
                        'payment_token' => sha1(md5(time())),
                        'payment_code' =>sha1(md5(time())),
                        'shortpay_code' => sha1(md5(time())),
                        'transaction_id' => sha1(md5(time())),
                        'transaction_type' => $request->transaction_type,
                        'ref' => $request->ref,
                        'phone' => $request->customer_id,
                        'amount' => $request->amount,
                        'account_number' => $request->account_number,
                        'status' => 'SUCCESS',
                        'bank' => 'GCB',
                        'description' => $request->ref,
                        'date' => $request->date,
                    ]);
                   $customer = Customer::getCustomer($request->customer_id);
                     if(count($customer)>0){
                        if($branch[0]['bank_journal_id']>0){
                            $data = [
                                'partner_id' => $customer[0]['id'],
                                'state' => 'draft',
                                'branch_id' => $branch[0]['id'],
                                'date' => $request->date,
                                'payment_type' => 'inbound',
                                'payment_method_id' => 1,
                                'company_id' => 2,
                                'amount' => $request->amount,
                                'journal_id' => $branch[0]['bank_journal_id'][0],
                                'ref' => $request->ref,
        
                            ];
                            $deposit = Customer::deposit($data);
                           }else{
                            info($branch[0]);
                            return response()->json([
                                'message' => "Someting went wrong",
                                'statusCode' => 500,
            
                            ], 500);
                           }
                  
                if($deposit){
                    Auth::user()->tokens->each(function($token, $key) {
                        $token->delete();
                    });
                    return response()->json([
                        'message' => "Payment Registered",
                        'statusCode' => 200,
    
                    ], 200);
                }
                }else{
                    $data = [
                        
                       
                        'phone' => $request->customer_id,
                        'name' => $request->customer_name,
                        'city' => $request->showroom,
                       
                    ];
                    Customer::creatCustomer($data);
                    $customer = Customer::getCustomer($request->customer_id);

                    $datac = [
                        'partner_id' => $customer[0]['id'],
                        'state' => 'draft',
                        'branch_id' => $branch[0]['id'],
                        'date' => $request->date,
                        'payment_type' => 'inbound',
                        'payment_method_id' => 1,
                        'company_id' => 2,
                        'amount' => $request->amount,
                        'journal_id' => $branch[0]['bank_journal_id'][0],
                        'ref' => $request->ref,

                    ];

                    $deposit = Customer::deposit($datac);
                if($deposit){
                    Auth::user()->tokens->each(function($token, $key) {
                        $token->delete();
                    });
                    return response()->json([
                        'message' => "Payment Registered",
                        'statusCode' => 200,
    
                    ], 200);
                }
                }
                }else{
                    info($branch);
                    // return $branch;
                    return response()->json([
                        'message' => "No showroom",
                        'statusCode' => 401,
    
                    ], 401);  
                }
                
            }else{
                return response()->json([
                    'message' => "Invalid showroom",
                    'statusCode' => 401,

                ], 401);   
            } 
        } catch (ResponseException $e) {
            report($e);
         info($e);
            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
      }catch(Exception $error){
        report($error);
        info($error);
        return response()->json([
            'message' => 'something went wrong',
            'statusCode' => 500,

        ], 500);
      }
       

       
    }


    public function apidoc(){
        return view('api');
    }
}
