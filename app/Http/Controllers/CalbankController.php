<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
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
        $total = Transaction::where('status', 'SUCCESS')->sum('amount');
        return view('transactions/calbank/daily', compact('total','activities'));
        //
    }
    public function indexweekly()
    { 
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total = Transaction::where('status', 'SUCCESS')->sum('amount');
        return view('transactions/calbank/weekly', compact('total','activities'));
        //
    }
    public function indexmonthly()
    { 
      
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total = Transaction::where('status', 'SUCCESS')->sum('amount');
        return view('transactions/calbank/monthly', compact('total','activities'));
        //
    }

    public function indexyearly()
    { 
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total = Transaction::where('status', 'SUCCESS')->sum('amount');
        return view('transactions/calbank/yearly', compact('total','activities'));
        //
    }
    public function daily(Request $request)
    {
       
       
       
        
        if ($request->ajax()) {
            $transactions_today = Transaction::where('status', 'SUCCESS')->whereDay('date',Carbon::now())->get();
     
            return DataTables::of($transactions_today)
                ->addIndexColumn()
                ->addColumn('transaction_id', function ($row) {

                    $actionBtn = '<a onclick="TransactionDetails(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
                    ' . $row->transaction_id . '
                </a>
               ';
                    return $actionBtn;
                })
                ->addColumn('name', function ($row) {
                    $actionBtn = ' <a href="#" class="text-primary">' . $row->name . '</a>
               
               ';
                    return $actionBtn;
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = $row->created_at->format('Y.m.d H:i:s');
                    return $created_at;
                })
                ->addColumn('status', function ($row) {
                    if($row->status =='PENDING'){
                        $actionBtn = ' <a href="https://calpay.caleservice.net/pay/secure/index.php?paytoken='.$row->transaction_id.'" class="text-primary">' . $row->status . '</a>
               
                        ';
                             return $actionBtn;
                    }else{
                        return $row->status;
                    }
                   
                })
                ->rawColumns(['transaction_id', 'name','status'])
                ->make(true);
        }
    }
    public function weekly(Request $request)
    {
       
        if ($request->ajax()) {
            $currentDate = Carbon::now();
            $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
            $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
             
            $transactions_week = Transaction::where('status', 'SUCCESS')->whereBetween('date', [$nowDate, $nextweekdate])->get();
      
            return DataTables::of($transactions_week)
                ->addIndexColumn()
                ->addColumn('transaction_id', function ($row) {

                    $actionBtn = '<a onclick="TransactionDetails(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
                    ' . $row->transaction_id . '
                </a>
               ';
                    return $actionBtn;
                })
                ->addColumn('name', function ($row) {
                    $actionBtn = ' <a href="#" class="text-primary">' . $row->name . '</a>
               
               ';
                    return $actionBtn;
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = $row->created_at->format('Y.m.d H:i:s');
                    return $created_at;
                })
                ->addColumn('status', function ($row) {
                    if($row->status =='PENDING'){
                        $actionBtn = ' <a href="https://calpay.caleservice.net/pay/secure/index.php?paytoken='.$row->transaction_id.'" class="text-primary">' . $row->status . '</a>
               
                        ';
                             return $actionBtn;
                    }else{
                        return $row->status;
                    }
                   
                })
                ->rawColumns(['transaction_id', 'name','status'])
                ->make(true);
        }
        //
    }

    public function monthly(Request $request)
    {
     
           if ($request->ajax()) {
            $transactions_month = Transaction::where('status', 'SUCCESS')->whereMonth('date', Carbon::now()->month)->get();
    
            return DataTables::of($transactions_month)
                ->addIndexColumn()
                ->addColumn('transaction_id', function ($row) {

                    $actionBtn = '<a onclick="TransactionDetails(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
                    ' . $row->transaction_id . '
                </a>
               ';
                    return $actionBtn;
                })
                ->addColumn('name', function ($row) {
                    $actionBtn = ' <a href="#" class="text-primary">' . $row->name . '</a>
               
               ';
                    return $actionBtn;
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = $row->created_at->format('Y.m.d H:i:s');
                    return $created_at;
                })
                ->addColumn('status', function ($row) {
                    if($row->status =='PENDING'){
                        $actionBtn = ' <a href="https://calpay.caleservice.net/pay/secure/index.php?paytoken='.$row->transaction_id.'" class="text-primary">' . $row->status . '</a>
               
                        ';
                             return $actionBtn;
                    }else{
                        return $row->status;
                    }
                   
                })
                ->rawColumns(['transaction_id', 'name','status'])
                ->make(true);
        }
        //
    }


    public function yearly(Request $request)
    {
        if ($request->ajax()) {
            $transactions_year = Transaction::where('status', 'SUCCESS')->whereYear( 'date', Carbon::now()->year)->get();
      
            return DataTables::of($transactions_year)
                ->addIndexColumn()
                ->addColumn('transaction_id', function ($row) {

                    $actionBtn = '<a onclick="TransactionDetails(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
                    ' . $row->transaction_id . '
                </a>
               ';
                    return $actionBtn;
                })
                ->addColumn('name', function ($row) {
                    $actionBtn = ' <a href="#" class="text-primary">' . $row->name . '</a>
               
               ';
                    return $actionBtn;
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = $row->created_at->format('Y.m.d H:i:s');
                    return $created_at;
                })
                ->addColumn('status', function ($row) {
                    if($row->status =='PENDING'){
                        $actionBtn = ' <a href="https://calpay.caleservice.net/pay/secure/index.php?paytoken='.$row->transaction_id.'" class="text-primary">' . $row->status . '</a>
               
                        ';
                             return $actionBtn;
                    }else{
                        return $row->status;
                    }
                   
                })
                ->rawColumns(['transaction_id', 'name','status'])
                ->make(true);
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
