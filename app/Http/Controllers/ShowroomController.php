<?php

namespace App\Http\Controllers;

use App\Models\Showroom;
use App\Models\Transaction;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Services\Helper;
class ShowroomController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Show Showroom|Create Showroom|Edit Showroom|Delete Showroom', ['only' => ['index','store']]);
         $this->middleware('permission:Create Showroom', ['only' => ['create','store']]);
         $this->middleware('permission:Edit Showroom', ['only' => ['edit','update']]);
         $this->middleware('permission:Delete Showroom', ['only' => ['destroy']]);
    }
    public function index()
    {
        $activities = Activity::where('model_name','App\Models\Showroom')->latest()->paginate(10);
        return view('showrooms/index',compact('activities'));
        //
    }

    public function details(Request $request)
    { 

       
        $currentDate = Carbon::now();
        $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
        $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
        $showroom = Showroom::where('name',$request->showroom)->first();

        $total = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('showroom',$request->showroom)->sum('amount'));
        $transactions_today = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('showroom',$request->showroom)->whereDay('created_at',Carbon::now())->sum('amount'));
        $transactions_week = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('showroom',$request->showroom)->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount'));
        $transactions_month = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('showroom',$request->showroom)->whereMonth( 'created_at', Carbon::now()->month)->sum('amount'));
        $transactions_year = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('showroom',$request->showroom)->whereYear( 'created_at', Carbon::now()->year)->sum('amount'));
       
        $calbank =Helper::money(Transaction::showroomtransations('CALBANK',$request->showroom));
        $gcb =Helper::money(Transaction::showroomtransations('GCB',$request->showroom));
        $uba =Helper::money(Transaction::showroomtransations('UBA',$request->showroom));
        $zenith =Helper::money(Transaction::showroomtransations('ZENITHBANK',$request->showroom));
       
        $momo =Helper::money(Transaction::showroomtransationsType('MOMO',$request->showroom));
        $cash =Helper::money(Transaction::showroomtransationsType('CASH',$request->showroom));
        $card =Helper::money(Transaction::showroomtransationsType('CARD',$request->showroom));
       
        return view('showrooms/details',compact('zenith','uba','momo','cash','card','total','gcb','showroom','calbank','transactions_year','transactions_today','transactions_week','transactions_month'));
   
    }

    public function transaction()
    {
        $currentDate = Carbon::now();
        $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
        $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
        $showrooms = Showroom::all();
        foreach($showrooms as $showroom){
            $transactions_today = DB::table('transactions')->where('showroom',$showroom->name)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereDay('created_at',Carbon::now())->sum('amount');
            $transactions_week = DB::table('transactions')->where('showroom',$showroom->name)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount');
            $transactions_month = DB::table('transactions')->where('showroom',$showroom->name)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereMonth( 'created_at', Carbon::now()->month)->sum('amount');
            $transactions_year = DB::table('transactions')->where('showroom',$showroom->name)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereYear( 'created_at', Carbon::now()->year)->sum('amount');
        
           $sum = Transaction::where('showroom',$showroom->name)->whereIn('status', ['SUCCESS','SUCCESSFUL'])->sum('amount');
           $gcbsum = Transaction::where('showroom',$showroom->name)->where('bank','GCB')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->sum('amount');
           $momo = Transaction::where('showroom',$showroom->name)->where('transaction_type','momo')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->sum('amount');
           $card = Transaction::where('showroom',$showroom->name)->where('bank','UBA')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->sum('amount');
           $showroom->update([
            'total'=>$sum,
            'gcb'=>$gcbsum,
            'momo'=>$momo,
            'today'=>$transactions_today,
            'month'=>$transactions_month,
            'week'=>$transactions_week,
            'year'=>$transactions_year
        ]);
          
        
        }
        $total = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->sum('amount'));
       
        return view('showrooms/transaction',compact('total'));
        //
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $users = Showroom::orderBy('id', 'desc')->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if(Auth::user()->can('Edit Showroom')){
                        $actionBtn = '<a onclick="ShowroomEdit('."'$row->id'".')"  href="javascript:void()" class="btn btn-primary btn-sm text-white">
                        Edit
                    </a>
                   ';
                   return $actionBtn;
                    }
                 
                    
                })
                ->addColumn('name', function($row){
                    $actionBtn = ' <a href="#" class="text-primary">'.$row->name.'</a>
               
               ';
                    return $actionBtn;
                })
                ->addColumn('created_at', function($row){
                    $created_at = $row->created_at->format('Y.m.d H:i:s');
                    return $created_at;
                })
                ->rawColumns(['action','name'])
                ->make(true);
        }
    } 

    public function translist(Request $request)
    {
        if ($request->ajax()) {
            $users = Showroom::all();
            return DataTables::of($users)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))){
                                return true;
                            }

                            return false;
                        });
                    }

                })
                ->addColumn('action', function($row){
                    if(Auth::user()->can('Edit Showroom')){
                        $actionBtn = '<a onclick="ShowroomEdit('."'$row->id'".')"  href="javascript:void()" class="btn btn-primary btn-sm text-white">
                        Edit
                    </a>
                   ';
                   return $actionBtn;
                    }
                 
                    
                })
                ->addColumn('name', function($row){
                    $actionBtn = ' <a href="'.route('showrooms.details').'?showroom='.$row->name.'" class="text-primary">'.$row->name.'</a>
               
               ';
                    return $actionBtn;
                })
                ->addColumn('created_at', function($row){
                    $created_at = $row->created_at->format('Y.m.d H:i:s');
                    return $created_at;
                })
                ->rawColumns(['action','name'])
                ->make(true);
        }
    } 


    public function gettable()
    {
        $list = Showroom::orderBy('id', 'desc')->paginate(10);
        
        return view("showrooms/table", compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('showrooms/create');
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

            'name' => 'required|unique:showrooms',
            
        ]);
      $showroom=  Showroom::updateOrCreate([
            'name'=>$request->name,
            'street'=>$request->street,
            'city'=>$request->city,
            'phone'=>$request->phone,
            'account_number'=>$request->account_number,
        ]);
        if($showroom){
            Activity::activityCreate('App\Models\Showroom','Showroom Created',$showroom->id);
            }
        return back();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Showroom  $showroom
     * @return \Illuminate\Http\Response
     */
    public function show(Showroom $showroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Showroom  $showroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Showroom $showroom,$id)
    {
      $showroom =  Showroom::find($id);
        return view('showrooms/edit',compact('showroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Showroom  $showroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Showroom $showroom,$id)
    {
        $showroom =  Showroom::find($id);
        if($showroom){
            Activity::activityCreate('App\Models\Showroom','Showroom Updated',$showroom->id);
               }
        $showroom->update([
            'name'=>$request->name,
        'street'=>$request->street,
        'city'=>$request->city,
        'phone'=>$request->phone,
        'account_number'=>$request->account_number,
    ]);
        return back();
    }





    public function indexdaily(Request $request)
    { 
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->whereDay('created_at',Carbon::now())->sum('amount'));
        $showroom = Showroom::where('name',$request->showroom)->first();
        return view('showrooms/daily', compact('total','activities','showroom'));
        //
    }
    public function all(Request $request)
    {  $showroom = Showroom::where('name',$request->showroom)->first();
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('showroom',$request->showroom)->sum('amount'));
        return view('showrooms/all', compact('total','activities','showroom'));
        //
    }

    public function indexweekly(Request $request)
    { 
        $currentDate = Carbon::now();
        $nowDate = Carbon::now()->subDays($currentDate->dayOfWeek+1);
        $nextweekdate = Carbon::now()->subDays($currentDate->dayOfWeek-7);
        $showroom = Showroom::where('name',$request->showroom)->first();
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('showroom',$request->showroom)->whereBetween('created_at', [$nowDate, $nextweekdate])->sum('amount'));
        return view('showrooms/weekly', compact('total','activities','showroom'));
        //
    }
    public function indexmonthly(Request $request)
    { 
        $showroom = Showroom::where('name',$request->showroom)->first();
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total = Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('showroom',$request->showroom)->whereMonth( 'created_at', Carbon::now()->month)->sum('amount'));
        return view('showrooms/monthly', compact('total','activities','showroom'));
        //
    }

    public function indexyearly(Request $request)
    { 
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
        $total =  Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('showroom',$request->showroom)->whereYear( 'created_at', Carbon::now()->year)->sum('amount'));
        $showroom = Showroom::where('name',$request->showroom)->first();
        return view('showrooms/yearly', compact('total','activities','showroom'));
        //
    }

    public function typeTrans(Request $request,$type)
    { 
        $activities = Activity::where('model_name','App\Models\Transaction')->latest()->paginate(10);
       $total='';
        if($type =='GCB'){
            
            $total =  Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('showroom',$request->showroom)->where('bank',$type)->sum('amount'));
        // dd( $total);
        }else{
            $total =  Helper::money(DB::table('transactions')->whereIn('status', ['SUCCESS','SUCCESSFUL'])->where('showroom',$request->showroom)->where('transaction_type',$type)->sum('amount'));
      
        }
         $showroom =$request->showroom;
        return view('showrooms/trans', compact('total','activities','showroom','type'));
        //
    }


    public function daily(Request $request,$showroom)
    {
       
        if(!empty($request->date1)){
            return Helper::datatable($showroom=$showroom,$date1=$request->date1,$date2=$request->date2,$transaction_type='',$period='today',$bank='',request());
    
        }else{
            return Helper::datatable($showroom=$showroom,$date1='',$date2='',$transaction_type='',$period='today',$bank='',request());
    
        }
       
        
        
    }

    //transactiontype
    public function transactionWithTypes(Request $request)
    {
       
        if(!empty($request->date1)){
            if($request->type =="GCB"){
                return Helper::datatable($showroom=$request->showroom,$date1=$request->date1,$date2=$request->date2,$transaction_type='',$period='',$bank=$request->type,request());
      
            }
            return Helper::datatable($showroom=$request->showroom,$date1=$request->date1,$date2=$request->date2,$transaction_type=$request->type,$period='',$bank='',request());
    
        }else{
            if($request->type =="GCB"){
                return Helper::datatable($showroom=$request->showroom,$date1='',$date2=$request->date2,$transaction_type='',$period='',$bank=$request->type,request());
      
            }
            return Helper::datatable($showroom=$request->showroom,$date1='',$date2='',$transaction_type=$request->type,$period='',$bank='',request());
    
        }
       
        
        
    }


    public function alllist(Request $request,$showroom)
    {
       
       
        if(!empty($request->date1)){
            return Helper::datatable($showroom=$showroom,$date1=$request->date1,$date2=$request->date2,$transaction_type='',$period='',$bank='',request());
    
        }else{
            return Helper::datatable($showroom=$showroom,$date1='',$date2='',$transaction_type='',$period='',$bank='',request());
    
        }
        
       
    }


    public function weekly(Request $request,$showroom)
    {
       
        if(!empty($request->date1)){
            return Helper::datatable($showroom=$showroom,$date1=$request->date1,$date2=$request->date2,$transaction_type='week',$period='',$bank='',request());
    
        }else{
            return Helper::datatable($showroom=$showroom,$date1='',$date2='',$transaction_type='',$period='week',$bank='',request());
    
        }
       
           
    }
    public function monthly(Request $request,$showroom)
    {
       
        if(!empty($request->date1)){
            return Helper::datatable($showroom=$showroom,$date1=$request->date1,$date2=$request->date2,$transaction_type='month',$period='',$bank='',request());
    
        }else{
            return Helper::datatable($showroom=$showroom,$date1='',$date2='',$transaction_type='',$period='month',$bank='',request());
    
        }
       
           
    }


    public function yearly(Request $request,$showroom)
    {
        if(!empty($request->date1)){
            return Helper::datatable($showroom=$showroom,$date1=$request->date1,$date2=$request->date2,$transaction_type='year',$period='',$bank='',request());
    
        }else{
            return Helper::datatable($showroom=$showroom,$date1='',$date2='',$transaction_type='',$period='year',$bank='',request());
    
        }


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Showroom  $showroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Showroom $showroom)
    {
        //
    }
}
