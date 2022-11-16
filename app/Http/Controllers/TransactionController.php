<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use App\Services\Banks\CalBank;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if(Auth::user()->can('Access All')){
            $activities =Activity::activities('App\Models\Transaction');
      
        $total = Transaction::transations('CALBANK');
        return view('transactions/index',compact('total','activities'));
    }else{
        $activities =Activity::activities('App\Models\Transaction');
        $total = Transaction::cashiertransation('CALBANK');
        return view('transactions/index',compact('total','activities'));
    }
       
        //
    }
    public function gcb()
    {
        if(Auth::user()->can('Access All')){
            $activities =Activity::activities('App\Models\Transaction');
      
        $total = Transaction::transations('GCB');
        return view('transactions/gcb',compact('total','activities'));
    }else{
        $activities =Activity::activities('App\Models\Transaction');
        $total = Transaction::cashiertransation('GCB');
        return view('transactions/gcb',compact('total','activities'));
    }
        //
    }

    public function uba()
    {
        if(Auth::user()->can('Access All')){
            $activities =Activity::activities('App\Models\Transaction');
       
        $total = Transaction::transationsu('UBA');
        return view('transactions/uba',compact('total','activities'));
        }else{
            $activities =Activity::activities('App\Models\Transaction');
            $total = Transaction::cashiertransation('UBA');
            return view('transactions/uba',compact('total','activities'));
        }
        //
    }
    public function zenith()
    {
     
        if(Auth::user()->can('Access All')){
            $activities =Activity::activities('App\Models\Transaction'); 
            $total = Transaction::transations('ZENITH');
        return view('transactions/zenith',compact('total','activities'));

        }else{
            $activities =Activity::activities('App\Models\Transaction');  
            $total = Transaction::cashiertransation('ZENITH');
        return view('transactions/zenith',compact('total','activities'));
        }
        //
    }


    public function callist(Request $request)
    {
        if ($request->ajax()) {
            if(Auth::user()->can('Access All')){
            $users = Transaction::getTransations('CALBANK');
          
            }else{
                $users = Transaction::getCashiertransations('CALBANK');
              
            }
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('transaction_id', function ($row) {

                    $actionBtn = '<a onclick="TransactionDetails(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
                    ' . $row->transaction_id . '
                </a>
               ';
                    return $actionBtn;
                })
                ->addColumn('amount', function ($row) {
                    $actionBtn = ' <div class="text-primary text-end">' . $row->amount . '</div>
               
               ';
                    return $actionBtn;
                })
                ->addColumn('sales_reference_id', function ($row) {

                    $actionBtn = '<a onclick="TransactionDetails(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
                    ' . $row->sales_reference_id . '
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
                ->rawColumns(['transaction_id','sales_reference_id','amount', 'name','status'])
                ->make(true);
        }

        
    }
    public function zenithlist(Request $request)
    {
        if ($request->ajax()) {
            if(Auth::user()->can('Access All')){
                $users = Transaction::getTransations('ZENITH');
              
                }else{
                    $users = Transaction::getCashiertransations('ZENITH');
                  
                }
          
            return DataTables::of($users)
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
                ->addColumn('amount', function ($row) {
                    $actionBtn = ' <div class="text-primary text-end">' . $row->amount . '</div>
               
               ';
                    return $actionBtn;
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = $row->created_at->format('Y.m.d H:i:s');
                    return $created_at;
                })
                ->rawColumns(['transaction_id','amount', 'name'])
                ->make(true);
        }
    }
    public function gcblist(Request $request)
    {
        if ($request->ajax()) {
            if(Auth::user()->can('Access All')){
                $users = Transaction::getTransations('GCB');
              
                }else{
                    $users = Transaction::getCashiertransations('GCB');
                  
                }
      
            return DataTables::of($users)
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
                ->addColumn('amount', function ($row) {
                    $actionBtn = ' <div class="text-primary text-end">' . $row->amount . '</div>
               
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
                ->rawColumns(['transaction_id','ref','amount', 'name'])
                ->make(true);
        }
    }

    public function ubalist(Request $request)
    {
        if ($request->ajax()) {
            if(Auth::user()->can('Access All')){
                $users = Transaction::getTransations('UBA');
              
                }else{
                    $users = Transaction::getCashiertransations('UBA');
                  
                }
           
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('transaction_id', function ($row) {

                    $actionBtn = '<a onclick="TransactionDetails(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
                        ' . $row->transaction_id . '
                    </a>
                   ';
                    return $actionBtn;
                })
                ->addColumn('sales_reference_id', function ($row) {

                    $actionBtn = '<a onclick="TransactionDetails(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
                        ' . $row->sales_reference_id . '
                    </a>
                   ';
                    return $actionBtn;
                })
                ->addColumn('name', function ($row) {
                    $actionBtn = ' <a href="#" class="text-primary">' . $row->name . '</a>
               
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
                    if($row->status =='CANCELED'){
                        $actionBtn = ' <a href="https://calpay.caleservice.net/pay/secure/index.php?paytoken='.$row->transaction_id.'" class="text-primary">' . $row->status . '</a>
               
                        ';
                             return $actionBtn;
                    }else{
                        return $row->status;
                    }
                   
                })
                ->rawColumns(['transaction_id','sales_reference_id','amount', 'name'])
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
        $validator = Validator::make($request->all(), [

            'name' => 'required',

        ]);
        Transaction::updateOrCreate($request->all());
        return back();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function load()
    {
        $transaction = Transaction::where('status', 'PENDING')->where('showroom', Auth::user()->showroom)->where('bank','CALBANK')->get();
        foreach ($transaction as $trans) {

            $data = CalBank::getTransactions($trans->transaction_id);

            if (json_decode($data->return)->CODE == 1) {
                return back()->with('error', json_decode($data->return)->MESSAGE);
            } else {
                if (json_decode($data->return)->RESULT[0]->FINALSTATUS != 'PENDING') {
                    Transaction::find($trans->id)->update(['status' => json_decode($data->return)->RESULT[0]->FINALSTATUS]);
                }
            }
        }
        return back();
    }

    public function show(Transaction $transaction, $id)
    {
        $transaction = Transaction::find($id);
        return view('transactions/show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
