<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Showroom;
use App\Models\Bank;
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
        $bank = Bank::where('status',"ACTIVE")->first()->name;
        if(Auth::user()->can('Access All')){
        if(!empty($request->date1)){
            $trans= Transaction::where('bank',$bank)->whereBetween('created_at', array($request->date1, $request->date2))->whereDay('created_at',Carbon::now())->orderBy('created_at', 'desc');
             
            return Helper::transist($request,$trans);
        }else{
            
            $trans= Transaction::where('bank',$bank)->whereDay('created_at',Carbon::now())->orderBy('created_at', 'desc');
             
            return Helper::transist($request,$trans);
        }
        }else{

        if(!empty($request->date1)){
            $trans= Transaction::where('showroom',Auth::user()->showroom)->whereDay('created_at',Carbon::now())->where('bank',$bank)->whereBetween('created_at', array($request->date1, $request->date2))->orderBy('created_at', 'desc');
          
             
            return Helper::transist($request,$trans);
       
        }else{
            $trans= Transaction::where('showroom',Auth::user()->showroom)->whereDay('created_at',Carbon::now())->where('bank',$bank)->orderBy('created_at', 'desc');
             
            return Helper::transist($request,$trans);
       
        }
        }
        
        
    }


    public function alllist(Request $request)
    {
        $bank = Bank::where('status',"ACTIVE")->first()->name;
        if(Auth::user()->can('Access All')){
        if(!empty($request->date1)){
            $trans= Transaction::where('bank',$bank)->whereBetween('created_at', array($request->date1, $request->date2));
             
            return Helper::transist($request,$trans);
          
        }else{
            
            $trans= Transaction::where('bank',$bank);
             
            return Helper::transist($request,$trans);
        }
    }else{
        if(!empty($request->date1)){
            $trans= Transaction::where('showroom',Auth::user()->showroom)->where('bank',$bank)->whereBetween('created_at', array($request->date1, $request->date2))->orderBy('created_at', 'desc');
          
             
            return Helper::transist($request,$trans);
           
        }else{
            $trans= Transaction::where('showroom',Auth::user()->showroom)->where('bank',$bank)->orderBy('created_at', 'desc');
             
            return Helper::transist($request,$trans);
           
        }
    }
       
    }


    public function weekly(Request $request)
    {
        $currentDate = Carbon::now();
        $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
        $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
         
        $bank = Bank::where('status',"ACTIVE")->first()->name;
  
        if(Auth::user()->can('Access All')){

          
            
             $trans= Transaction::where('bank',$bank)->whereBetween('created_at', array($nowDate, $nextweekdate))->orderBy('created_at', 'desc');
             
            return Helper::transist($request,$trans);
        if(!empty($request->date1)){
            $trans= Transaction::where('bank',$bank)->whereBetween('created_at', array($nowDate, $nextweekdate))->whereBetween('created_at', array($request->date1, $request->date2))->orderBy('created_at', 'desc');
             
            return Helper::transist($request,$trans);
            
    
        }else{
            
        }
    }else{
        if(!empty($request->date1)){
            $trans= Transaction::where('bank',$bank)->where('showromm',Auth::user()->showroom)->whereBetween('created_at', array($nowDate, $nextweekdate))->whereBetween('created_at', array($request->date1, $request->date2))->orderBy('created_at', 'desc');
            return Helper::transist($request,$trans);
           
        }else{
            $trans= Transaction::where('bank',$bank)->where('showromm',Auth::user()->showroom)->whereBetween('created_at', array($nowDate, $nextweekdate))->orderBy('created_at', 'desc');
            return Helper::transist($request,$trans);
        }
    }
        
        //
    }

    public function monthly(Request $request)
    {
        $bank = Bank::where('status',"ACTIVE")->first()->name;
        if(Auth::user()->can('Access All')){
        if(!empty($request->date1)){
            $trans= Transaction::where('bank',$bank)->whereMonth( 'created_at', Carbon::now()->month)->whereBetween('created_at', array($request->date1, $request->date2))->orderBy('created_at', 'desc');
            return Helper::transist($request,$trans);
        }else{
            $trans= Transaction::where('bank',$bank)->whereMonth( 'created_at', Carbon::now()->month)->orderBy('created_at', 'desc');
             
            return Helper::transist($request,$trans);
        }
    }else{
        if(!empty($request->date1)){
            $trans= Transaction::where('bank',$bank)->whereMonth( 'created_at', Carbon::now()->month)->where('showromm',Auth::user()->showroom)->whereBetween('created_at', array($request->date1, $request->date2))->orderBy('created_at', 'desc');
            return Helper::transist($request,$trans);
        }else{
            $trans= Transaction::where('bank',$bank)->whereMonth( 'created_at', Carbon::now()->month)->where('showromm',Auth::user()->showroom)->orderBy('created_at', 'desc');
            return Helper::transist($request,$trans);
        }
        }
          
        
    }


    public function yearly(Request $request)
    {
        $bank = Bank::where('status',"ACTIVE")->first()->name;
        if(Auth::user()->can('Access All')){
        if(!empty($request->date1)){
            $trans= Transaction::where('bank',$bank)->whereYear( 'created_at', Carbon::now()->year)->whereBetween('created_at', array($request->date1, $request->date2))->orderBy('created_at', 'desc');
            return Helper::transist($request,$trans);
      
        }else{
            $trans= Transaction::where('bank',$bank)->whereYear( 'created_at', Carbon::now()->year)->orderBy('created_at', 'desc');
            return Helper::transist($request,$trans);
      
        }
        }else{

        

        if(!empty($request->date1)){
            $trans= Transaction::where('bank',$bank)->whereYear( 'created_at', Carbon::now()->year)->where('showromm',Auth::user()->showroom)->whereBetween('created_at', array($request->date1, $request->date2));
            return Helper::transist($request,$trans);
      
        }else{
            $trans= Transaction::where('bank',$bank)->whereYear( 'created_at', Carbon::now()->year)->where('showromm',Auth::user()->showroom);
            return Helper::transist($request,$trans);
      
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
