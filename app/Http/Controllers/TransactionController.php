<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use App\Services\Banks\CalBank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\Helper;
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
      
        $total = Helper::money(Transaction::transations('CALBANK'));
        return view('transactions/index',compact('total','activities'));
    }else{
        $activities =Activity::activities('App\Models\Transaction');
        $total = Helper::money(Transaction::cashiertransation('CALBANK'));
        return view('transactions/index',compact('total','activities'));
    }
       
        //
    }
    public function gcb()
    {
        if(Auth::user()->can('Access All')){
            $activities =Activity::activities('App\Models\Transaction');
      
        $total = Helper::money(Transaction::transations('GCB'));
        return view('transactions/gcb',compact('total','activities'));
    }else{
        $activities =Activity::activities('App\Models\Transaction');
        $total = Helper::money(Transaction::cashiertransation('GCB'));
        return view('transactions/gcb',compact('total','activities'));
    }
        //
    }

    public function uba()
    {
        if(Auth::user()->can('Access All')){
            $activities =Activity::activities('App\Models\Transaction');
       
        $total = Helper::money(Transaction::transationsu('UBA'));
        return view('transactions/uba',compact('total','activities'));
        }else{
            $activities =Activity::activities('App\Models\Transaction');
            $total = Helper::money(Transaction::cashiertransation('UBA'));
            return view('transactions/uba',compact('total','activities'));
        }
        //
    }
    public function zenith()
    {
     
        if(Auth::user()->can('Access All')){
            $activities =Activity::activities('App\Models\Transaction'); 
            $total = Helper::money(Transaction::transations('ZENITH'));
        return view('transactions/zenith',compact('total','activities'));

        }else{
            $activities =Activity::activities('App\Models\Transaction');  
            $total = Helper::money(Transaction::cashiertransation('ZENITH'));
        return view('transactions/zenith',compact('total','activities'));
        }
        //
    }


    public function callist(Request $request)
    {
        if ($request->ajax()) {

            if(!empty($request->date1))
            {
             $trans = Transaction::where('bank','CALBANK')->whereBetween('created_at', array($request->date1, $request->date2))
               ->get();
            }
            else
            {
                if(Auth::user()->can('Access All')){
                    $trans = Transaction::getTransations('CALBANK');
                  
                    }else{
                        $trans = Transaction::getCashiertransations('CALBANK');
                      
                    }
            }
            
            return DataTables::of($trans)
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

            if(!empty($request->date1))
            {
             $trans = Transaction::where('bank','ZENITH')->whereBetween('created_at', array($request->date1, $request->date2))
               ->get();
            }
            else
            {
                if(Auth::user()->can('Access All')){
                    $trans = Transaction::getTransations('ZENITH');
                  
                    }else{
                        $trans = Transaction::getCashiertransations('ZENITH');
                      
                    }
            }
           
          
            return DataTables::of($trans)
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

            if(!empty($request->date1))
            {
             $trans = Transaction::where('bank','GCB')->whereBetween('created_at', array($request->date1, $request->date2))
               ->get();
            }
            else
            {
                if(Auth::user()->can('Access All')){
                    $trans = Transaction::getTransations('GCB');
                  
                    }else{
                        $trans = Transaction::getCashiertransations('GCB');
                      
                    }
            }
            
      
            return DataTables::of($trans)
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
            if(!empty($request->date1))
            {
             $trans = Transaction::where('bank','UBA')->whereBetween('created_at', array($request->date1, $request->date2))
               ->get();
            }
            else
            {
                
            if(Auth::user()->can('Access All')){
                $trans = Transaction::getTransations('UBA');
              
                }else{
                    $trans = Transaction::getCashiertransations('UBA');
                  
                }
           
            }

            return DataTables::of($trans)
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
