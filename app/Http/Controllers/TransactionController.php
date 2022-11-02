<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
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
        $total = Transaction::where('status', 'SUCCESS')->where('bank','CALBANK')->sum('amount');
        return view('transactions/index', compact('total'));
        //
    }
    public function gcb()
    {
        $total = Transaction::where('bank','GCB')->sum('amount');
        return view('transactions/gcb',compact('total'));
        //
    }

    public function uba()
    {
        $total = Transaction::where('status', 'SUCCESS')->where('bank','UBA')->sum('amount');
        return view('transactions/uba',compact('total'));
        //
    }
    public function zenith()
    {
        $total = Transaction::where('status', 'SUCCESS')->where('bank','ZENITH')->sum('amount');
        return view('transactions/zenith',compact('total'));
        //
    }


    public function callist(Request $request)
    {
        if ($request->ajax()) {
            $users = Transaction::where('bank','CALBANK')->get();
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
                ->addColumn('created_at', function ($row) {
                    $created_at = $row->created_at->format('Y.m.d H:i:s');
                    return $created_at;
                })
                ->rawColumns(['transaction_id', 'name'])
                ->make(true);
        }
    }
    public function zenithlist(Request $request)
    {
        if ($request->ajax()) {
            $users = Transaction::where('bank','ZENITH')->get();
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
                ->addColumn('created_at', function ($row) {
                    $created_at = $row->created_at->format('Y.m.d H:i:s');
                    return $created_at;
                })
                ->rawColumns(['transaction_id', 'name'])
                ->make(true);
        }
    }
    public function gcblist(Request $request)
    {
        if ($request->ajax()) {
            $users = Transaction::where('bank','GCB')->orderBy('id', 'desc')->get();
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
                ->addColumn('created_at', function ($row) {
                    $created_at = $row->created_at->format('Y.m.d H:i:s');
                    return $created_at;
                })
                ->rawColumns(['transaction_id', 'name'])
                ->make(true);
        }
    }

    public function ubalist(Request $request)
    {
        if ($request->ajax()) {
            $users = Transaction::where('bank','UBA')->orderBy('id', 'desc')->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('transaction_id', function ($row) {

                    $actionBtn = '<a onclick="ShowroomEdit(' . "'$row->id'" . ')"  href="javascript:void()" class="text-primary">
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
                ->rawColumns(['transaction_id', 'name'])
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
