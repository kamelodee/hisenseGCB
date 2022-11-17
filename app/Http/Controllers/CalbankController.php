<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;
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
        $total = DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereDay('created_at',Carbon::now())->sum('amount');
        return view('transactions/calbank/daily', compact('total','activities'));
        //
    }
    public function all()
    { 
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total = DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->sum('amount');
        return view('transactions/all', compact('total','activities'));
        //
    }

    public function indexweekly()
    { 
        $currentDate = Carbon::now();
        $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
        $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
       
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total = DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount');
        return view('transactions/calbank/weekly', compact('total','activities'));
        //
    }
    public function indexmonthly()
    { 
      
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total = DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereMonth( 'created_at', Carbon::now()->month)->sum('amount');
        return view('transactions/calbank/monthly', compact('total','activities'));
        //
    }

    public function indexyearly()
    { 
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total =  DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereYear( 'created_at', Carbon::now()->year)->sum('amount');
   
        return view('transactions/calbank/yearly', compact('total','activities'));
        //
    }
    public function daily(Request $request)
    {
       
       
       
        
        if ($request->ajax()) {
            $transactions_today = Transaction::whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereDay('created_at',Carbon::now())->get();
     
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
                ->addColumn('amount', function ($row) {
                    $actionBtn = ' <div class="text-primary text-end">' . $row->amount . '</div>
               
               ';
                    return $actionBtn;
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
                ->rawColumns(['transaction_id','amount', 'name','status'])
                ->make(true);
        }
    }


    public function alllist(Request $request)
    {
       
       
       
        
        if ($request->ajax()) {
           
            if(!empty($request->date1))
            {
             $transactions_today = Transaction::whereBetween('created_at', array($request->date1, $request->date2))
               ->get();
            }
            else
            {
                $transactions_today = Transaction::whereIn('status', ['SUCCESS','SUCCESSFUL'])->get();
            }

            return DataTables::of($transactions_today)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['showroom']), Str::lower($request->get('search')))){
                                return true;
                            }
                            if (Str::contains(Str::lower($row['transaction_type']), Str::lower($request->get('search')))){
                                return true;
                            }
                            if (Str::contains(Str::lower($row['ref']), Str::lower($request->get('search')))){
                                return true;
                            }
                            if (Str::contains(Str::lower($row['sales_reference_id']), Str::lower($request->get('search')))){
                                return true;
                            }
                            if (Str::contains(Str::lower($row['bank']), Str::lower($request->get('search')))){
                                return true;
                            }
                           

                            return false;
                        });
                    }


                   

                })
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
                ->addColumn('amount', function ($row) {
                    $actionBtn = ' <div class="text-primary text-end">' . $row->amount . '</div>
               
               ';
                    return $actionBtn;
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
                ->rawColumns(['transaction_id','amount', 'name','status'])
                ->make(true);
        }
    }


    public function weekly(Request $request)
    {
       
        if ($request->ajax()) {
            $currentDate = Carbon::now();
            $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
            $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
             
            $transactions_week = Transaction::whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereBetween('created_at', [$nowDate, $nextweekdate])->get();
      
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
                ->addColumn('ref', function ($row) {

                    $actionBtn = '<a onclick="TransactionDetails(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
                        ' . $row->ref . '
                    </a>
                   ';
                    return $actionBtn;
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = $row->created_at->format('Y.m.d H:i:s');
                    return $created_at;
                })
                ->addColumn('amount', function ($row) {
                    $actionBtn = ' <div class="text-primary text-end">' . $row->amount . '</div>
               
               ';
                    return $actionBtn;
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
                ->rawColumns(['transaction_id','ref','amount', 'name','status'])
                ->make(true);
        }
        //
    }

    public function monthly(Request $request)
    {
     
           if ($request->ajax()) {
            $transactions_month = Transaction::whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereMonth('created_at', Carbon::now()->month)->get();
    
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
                ->addColumn('amount', function ($row) {
                    $actionBtn = ' <div class="text-primary text-end">' . $row->amount . '</div>
               
               ';
                    return $actionBtn;
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
                ->rawColumns(['transaction_id','amount', 'name','status'])
                ->make(true);
        }
        //
    }


    public function yearly(Request $request)
    {
        if ($request->ajax()) {
            $transactions_year = Transaction::whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereYear( 'created_at', Carbon::now()->year)->get();
      
            return DataTables::of($transactions_year)
                ->addIndexColumn()
                ->addColumn('transaction_id', function ($row) {

                    $actionBtn = '<a onclick="TransactionDetails(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
                    ' . $row->transaction_id . '
                </a>
               ';
                    return $actionBtn;
                })
                ->addColumn('ref', function ($row) {

                    $actionBtn = '<a onclick="TransactionDetails(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
                        ' . $row->ref . '
                    </a>
                   ';
                    return $actionBtn;
                })
                ->addColumn('name', function ($row) {
                    $actionBtn = ' <a href="#" class="text-primary text-end">' . $row->name . '</a>
               
               ';
                    return $actionBtn;
                })
                ->addColumn('amount', function ($row) {
                    $actionBtn = ' <div class="text-primary text-end">' . $row->amount . '</div>
               
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
                ->rawColumns(['transaction_id','amount','ref', 'name','status'])
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
