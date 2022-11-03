<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentDate = Carbon::now();
        $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
        $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
       
        $transactions_today = DB::table('transactions')->where('status', 'SUCCESS')->whereDay('date',Carbon::now())->sum('amount');
        $transactions_week = DB::table('transactions')->where('status', 'SUCCESS')->whereBetween('date', [$nowDate, $nextweekdate])->sum('amount');
        $transactions_month = DB::table('transactions')->where('status', 'SUCCESS')->whereMonth( 'date', Carbon::now()->month)->sum('amount');
        $transactions_year = DB::table('transactions')->where('status', 'SUCCESS')->whereYear( 'date', Carbon::now()->year)->sum('amount');
       
        $calbank =Transaction::where('bank','CALBANK')->where('status', 'SUCCESS')->sum('amount');
        $gcb =Transaction::where('bank','GCB')->where('status', 'SUCCESS')->sum('amount');
        $uba =Transaction::where('bank','UBA')->where('status', 'SUCCESS')->sum('amount');
        $zenith =Transaction::where('bank','ZENITHBANK')->where('status', 'SUCCESS')->sum('amount');

        return view('dashboard',compact('zenith','uba','gcb','calbank','transactions_year','transactions_today','transactions_week','transactions_month'));
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
