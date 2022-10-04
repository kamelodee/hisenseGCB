<?php

namespace App\Http\Controllers\Odoo;

use App\Services\Odoo\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ripoo\Exception\{CodingException, ResponseException, ResponseEntryException, ResponseFaultException, ResponseStatusException};


class CustomerController extends Controller
{

    public function getCustomers()
    {
        return Customer::getCustomers();
    }

    public function getCustomer($phone)
    {
        return Customer::getCustomer($phone);
    }


    public function createCustomer(Request $request)
    {
        if ($request->name & $request->phone) {
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'street' => $request->address,
                'city' => $request->city,
            ];
        }

        return Customer::creatCustomer($data);
    }


    public function updateCustomer(Request $request)
    {
        if ($request->phone) {
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'street' => $request->address,
                'city' => $request->city,
                'email' => $request->email,
            ];
            return Customer::updateCustomer($data);
        }
    }

    public function customerFields()
    {
        return Customer::customerFields();
    }

    public function accountFields()
    {
        return Customer::accountFields();
    }

    public function ranch()
    {
        return Customer::branchFields();
    }


    
    public function deposit(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'showroom' => 'required',
            'customer_id' => 'required',
            'customer_name' => 'required',
            'ref' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 401,
                'error' => $validator->messages()
            ], 401);
        }
        try {
            // return $request->all();
                $branch = Customer::branch($request->showroom);
                // return $branch[0]['bank_journal_id'];
            $branch = Customer::branch($request->showroom);
                // return $branch[0]['bank_journal_id'];
                if ($branch[0]['id'] > 0) {
                    $customer = Customer::getCustomer($request->customer_id);
                     if($customer[0]['id']>0){
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
                if($deposit){
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

                    $deposit = Customer::deposit($data);
                if($deposit){
                    return response()->json([
                        'message' => "Payment Registered",
                        'statusCode' => 200,
    
                    ], 200);
                }
                }
                }
                
            
        } catch (ResponseException $e) {
            report($e);
         info($e);
            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
    }
}
