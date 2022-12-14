<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Transaction;
use App\Models\Showroom;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Services\Helper;
use NumberFormatter;
use PHPUnit\TextUI\Help;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

    
        $bank = Bank::where('status',"ACTIVE")->first()->name;
    
   
        if(Auth::user()->can('Access All')){

            
        $currentDate = Carbon::now();
        $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
        $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
       $showrooms = Showroom::all();
        $total = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->sum('amount'));
       

        $transactions_today = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereDate('created_at',DB::raw('CURDATE()'))->sum('amount'));
        $transactions_week = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount'));
        $transactions_month = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereMonth( 'created_at', Carbon::now()->month)->sum('amount'));
        $transactions_year = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereYear( 'created_at', Carbon::now()->year)->sum('amount'));
       
        $transactions_todaymomo = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('transaction_type','MOMO')->whereDay('created_at',Carbon::now())->sum('amount'));
        $transactions_weekmomo = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('transaction_type','MOMO')->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount'));
        $transactions_monthmomo = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('transaction_type','MOMO')->whereMonth( 'created_at', Carbon::now()->month)->sum('amount'));
        $transactions_yearmomo = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('transaction_type','MOMO')->whereYear( 'created_at', Carbon::now()->year)->sum('amount'));
       
        $transactions_todaydepo = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('transaction_type','DEPOSIT')->whereDay('created_at',Carbon::now())->sum('amount'));
        $transactions_weekdepo = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('transaction_type','DEPOSIT')->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount'));
        $transactions_monthdepo = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('transaction_type','DEPOSIT')->whereMonth( 'created_at', Carbon::now()->month)->sum('amount'));
        $transactions_yeardepo = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('transaction_type','DEPOSIT')->whereYear( 'created_at', Carbon::now()->year)->sum('amount'));
       
        $transactions_todaycard = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('transaction_type','CARD')->whereDay('created_at',Carbon::now())->sum('amount'));
        $transactions_weekcard = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('transaction_type','CARD')->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount'));
        $transactions_monthcard = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('transaction_type','CARD')->whereMonth( 'created_at', Carbon::now()->month)->sum('amount'));
        $transactions_yearcard = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('transaction_type','CARD')->whereYear( 'created_at', Carbon::now()->year)->sum('amount'));
       
           
        $calbank =Helper::money(Transaction::transations('CALBANK'));
        $gcb =Helper::money(Transaction::transations('GCB'));
        $uba =Helper::money(Transaction::transationsu('UBA'));
        $zenith =Helper::money(Transaction::transations('ZENITH'));
       
        return view('dashboard',compact('zenith',
        'uba','total','gcb','showrooms',
        'calbank',
        'transactions_yearmomo',
        'transactions_todaymomo',
        'transactions_weekmomo',
        'transactions_monthmomo',
        'transactions_yeardepo',
        'transactions_todaydepo',
        'transactions_weekdepo',
        'transactions_monthdepo',
        'transactions_yearcard',
        'transactions_todaycard',
        'transactions_weekcard',
        'transactions_monthcard',
        'transactions_year',
        'transactions_today',
        'transactions_week',
        'transactions_month'
    ));
    }else{
        $currentDate = Carbon::now();
        $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
        $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
        $total = Helper::money(DB::table('transactions')->where('bank',$bank)->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->sum('amount'));
       
        $transactions_today = Helper::money(DB::table('transactions')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereDay('created_at',Carbon::now())->sum('amount'));
        $transactions_week = Helper::money(DB::table('transactions')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount'));
        $transactions_month = Helper::money(DB::table('transactions')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereMonth( 'created_at', Carbon::now()->month)->sum('amount'));
        $transactions_year = Helper::money(DB::table('transactions')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereYear( 'created_at', Carbon::now()->year)->sum('amount'));
     
        $transactions_todaymomo = Helper::money(DB::table('transactions')->where('transaction_type','MOMO')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereDay('created_at',Carbon::now())->sum('amount'));
        $transactions_weekmomo = Helper::money(DB::table('transactions')->where('transaction_type','MOMO')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount'));
        $transactions_monthmomo = Helper::money(DB::table('transactions')->where('transaction_type','MOMO')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereMonth( 'created_at', Carbon::now()->month)->sum('amount'));
        $transactions_yearmomo = Helper::money(DB::table('transactions')->where('transaction_type','MOMO')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereYear( 'created_at', Carbon::now()->year)->sum('amount'));
     
        $transactions_todaydepo = Helper::money(DB::table('transactions')->where('transaction_type','DEPOSIT')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereDay('created_at',Carbon::now())->sum('amount'));
        $transactions_weekdepo = Helper::money(DB::table('transactions')->where('transaction_type','DEPOSIT')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount'));
        $transactions_monthdepo = Helper::money(DB::table('transactions')->where('transaction_type','DEPOSIT')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereMonth( 'created_at', Carbon::now()->month)->sum('amount'));
        $transactions_yeardepo = Helper::money(DB::table('transactions')->where('transaction_type','DEPOSIT')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereYear( 'created_at', Carbon::now()->year)->sum('amount'));
     
        $transactions_todaycard = Helper::money(DB::table('transactions')->where('transaction_type','CARD')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereDay('created_at',Carbon::now())->sum('amount'));
        $transactions_weekcard = Helper::money(DB::table('transactions')->where('bank',$bank)->where('transaction_type','CARD')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount'));
        $transactions_monthcard = Helper::money(DB::table('transactions')->where('transaction_type','CARD')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereMonth( 'created_at', Carbon::now()->month)->sum('amount'));
        $transactions_yearcard = Helper::money(DB::table('transactions')->where('transaction_type','CARD')->where('showroom',Auth::user()->showroom)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereYear( 'created_at', Carbon::now()->year)->sum('amount'));
     
        $showroom='';
        $calbank =Helper::money(Transaction::cashiertransation('CALBANK'));
        $gcb =Helper::money(Transaction::cashiertransation('GCB'));
        $uba =Helper::money(Transaction::cashiertransation('UBA'));
        $zenith =Helper::money(Transaction::cashiertransation('ZENITH'));
       
        return view('dashboard',compact('zenith','total','uba','gcb','calbank',
        'transactions_yearmomo',
        'transactions_todaymomo',
        'transactions_weekmomo',
        'transactions_monthmomo',
        'transactions_yeardepo',
        'transactions_todaydepo',
        'transactions_weekdepo',
        'transactions_monthdepo',
        'transactions_yearcard',
        'transactions_todaycard',
        'transactions_weekcard',
        'transactions_monthcard',
        'transactions_year',
        'transactions_today',
        'transactions_week',
        'transactions_month',

        'showroom'));  
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
