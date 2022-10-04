<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Services\Odoo;
class ApiController extends Controller
{


  public  function v4_UUID() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
          // 32 bits for the time_low
          mt_rand(0, 0xffff), mt_rand(0, 0xffff),
          // 16 bits for the time_mid
          mt_rand(0, 0xffff),
          // 16 bits for the time_hi,
          mt_rand(0, 0x0fff) | 0x4000,

          // 8 bits and 16 bits for the clk_seq_hi_res,
          // 8 bits for the clk_seq_low,
          mt_rand(0, 0x3fff) | 0x8000,
          // 48 bits for the node
          mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
      }

    public function login(Request $request)
    {
       info($request->all());
        $validator = Validator::make($request->all(), [

            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 401,
                'error' => $validator->messages()
            ], 200);
        }

        $credentials = $request->only('phone', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('phone', $request->phone)->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'statusCode' => 200,
                'user' =>[
                    "firstName"=>$user->fisrtName,
                    "lastName"=>$user->lastName,
                    "phoneImei" =>$user->phoneImei ,
                    "phone" =>$user->phone ,
                ]
            ], 200);
        }else{
            return response()->json([
                'message' => "Invalid login details",
                'statusCode' => 401,
            ], 401);
        }

    }

    public function register(Request $request)
    {

        // dd($request->all());
$odoou = Odoo::getemployeebyphone($request->phone);

if(!empty($odoou)){
    $validator = Validator::make($request->all(), [
        'firstName' => 'required',
        'lastName' => 'required',
        'phone' => 'required|unique:users,phone,except,id',
        'phoneImei' => 'required|unique:users,phoneImei,except,id',
        'password' => 'required|string|confirmed|min:4',
    ]);
        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 401,
                'error' => $validator->messages()
            ], 200);
        }
        $usermodel = new User;
    $usermodel->unsetEventDispatcher();
        $user = User::create([
            'id'=>$this->v4_UUID(),
            'name' => '.'.$request->firstName.$request->lastName.'',
            'phone' => $request->phone,
            'phoneImei' => $request->phoneImei,
            'password' => Hash::make($request->password),
        ]);



        Auth::login($user);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'statusCode' => 200,
            'user' =>[
                "firstName"=>$user->firstName,
                "lastName"=>$user->lastName,
                "phoneImei" =>$user->phoneImei ,
                "phone" =>$user->phone ,
            ]
        ], 200);
    }else{
        return response()->json([
            'message' => "Please Update Your Phone Number with HR",
            'statusCode' => 401,

        ], 401);
    }

}
}
