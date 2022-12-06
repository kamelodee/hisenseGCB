<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Showroom;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

use Illuminate\Support\Str;
use App\Services\Helper;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class CalbankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function indexdaily()
    { 
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereDay('created_at',Carbon::now())->sum('amount'));
        return view('transactions/calbank/daily', compact('total','activities'));
        //
    }
    public function all()
    { 





        if(Auth::user()->can('Access All')){

            
            $currentDate = Carbon::now();
            $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
            $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
           $showrooms = Showroom::all();
            $total = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->sum('amount'));
           
    
            $transactions_today = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereDay('created_at',Carbon::now())->sum('amount'));
            $transactions_week = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount'));
            $transactions_month = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereMonth( 'created_at', Carbon::now()->month)->sum('amount'));
            $transactions_year = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereYear( 'created_at', Carbon::now()->year)->sum('amount'));
           
            $calbank =Helper::money(Transaction::transations('CALBANK'));
            $gcb =Helper::money(Transaction::transations('GCB'));
            $uba =Helper::money(Transaction::transationsu('UBA'));
            $zenith =Helper::money(Transaction::transations('ZENITH'));
           
            return view('transactions/all',compact('zenith','uba','total','gcb','showrooms','calbank','transactions_year','transactions_today','transactions_week','transactions_month'));
        }else{
            $currentDate = Carbon::now();
            $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
            $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
            $total = Helper::money(DB::table('transactions')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->sum('amount'));
           
            $transactions_today = Helper::money(DB::table('transactions')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereDay('created_at',Carbon::now())->sum('amount'));
            $transactions_week = Helper::money(DB::table('transactions')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount'));
            $transactions_month = Helper::money(DB::table('transactions')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereMonth( 'created_at', Carbon::now()->month)->sum('amount'));
            $transactions_year = Helper::money(DB::table('transactions')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereYear( 'created_at', Carbon::now()->year)->sum('amount'));
           $showroom='';
            $calbank =Helper::money(Transaction::cashiertransation('CALBANK'));
            $gcb =Helper::money(Transaction::cashiertransation('GCB'));
            $uba =Helper::money(Transaction::cashiertransation('UBA'));
            $zenith =Helper::money(Transaction::cashiertransation('ZENITH'));
           
            return view('transactions/all',compact('zenith','total','uba','gcb','calbank','transactions_year','transactions_today','transactions_week','transactions_month','showroom'));  
        }

          }

    public function indexweekly()
    { 
        $currentDate = Carbon::now();
        $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
        $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
       
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount'));
        return view('transactions/calbank/weekly', compact('total','activities'));
        //
    }
    public function indexmonthly()
    { 
      
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereMonth( 'created_at', Carbon::now()->month)->sum('amount'));
        return view('transactions/calbank/monthly', compact('total','activities'));
        //
    }

    public function indexyearly()
    { 
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total =  Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereYear( 'created_at', Carbon::now()->year)->sum('amount'));
   
        return view('transactions/calbank/yearly', compact('total','activities'));
        //
    }
    public function daily(Request $request)
    {
       
       
        if(!empty($request->date1)){
            return Helper::datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='',$bank='today',request());
    
        }else{
            return Helper::datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='today',$bank='',request());
    
        }
        
        
    }


    public function alllist(Request $request)
    {
       
        if(!empty($request->date1)){
            return Helper::datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='',$bank='',request());
    
        }else{
            return Helper::datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='',$bank='',request());
    
        }
       
       
    }


    public function weekly(Request $request)
    {
       
        if(!empty($request->date1)){
            return Helper::datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='week',$bank='',request());
    
        }else{
            return Helper::datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='week',$bank='',request());
    
        }

        
        //
    }

    public function monthly(Request $request)
    {
     
        if(!empty($request->date1)){
            return Helper::datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='month',$bank='',request());
    
        }else{
            return Helper::datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='month',$bank='',request());
    
        }
          
        
    }


    public function yearly(Request $request)
    {

        if(!empty($request->date1)){
            return Helper::datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='year',$bank='',request());
    
        }else{
            return Helper::datatable($showroom='',$date1='',$date2='',$transaction_type='',$period='year',$bank='',request());
    
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
