<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;
use App\Models\IpAddress;
class WhiteListIpAddressessMiddleware
{

    
    
    public function handle(Request $request, Closure $next)
    {
        // return $request->getClientIp();
        $ips  =IpAddress::whereIn('ip_address',[$request->getClientIp()])->get();
        if (count($ips)< 1) {
            return response()->json([
                'message' => "You are restricted to access the site.",
                'statusCode' => 403,
            ], 403);
           
        }

        return $next($request);
    }
}
