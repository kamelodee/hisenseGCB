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
use App\Services\Odoo;

use App\Services\Odoo\Customer;
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

    
    public function deposit(Request $request)
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
            if(Auth::user()->showroom == $request->showroom){
            $branch = Customer::branch(Auth::user()->showroom);
                if (count($branch) > 0 ) {
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
                    return response()->json([
                        'message' => "Invalid showroom",
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
}
