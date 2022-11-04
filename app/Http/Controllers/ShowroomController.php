<?php

namespace App\Http\Controllers;

use App\Models\Showroom;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\Auth;
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

            'name' => 'required',
            
        ]);
      $showroom=  Showroom::updateOrCreate([
            'name'=>$request->name,
            'street'=>$request->street,
            'city'=>$request->city,
            'phone'=>$request->phone,
        ]);
        if($showroom){
            Activity::create(['user_id'=>Auth::user()->id,'user_name'=>Auth::user()->name,'showroom'=>Auth::user()->showroom,'description'=>"Showroom created",'model_id'=>$showroom->id,'model_name'=>'App\Models\Showroom']);
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
            Activity::create(['user_id'=>Auth::user()->id,'user_name'=>Auth::user()->name,'showroom'=>Auth::user()->showroom,'description'=>"Showroom Updated",'model_id'=>$showroom->id,'model_name'=>'App\Models\Showroom']);
        }
        $showroom->update([
            'name'=>$request->name,
        'street'=>$request->street,
        'city'=>$request->city,
        'phone'=>$request->phone,]);
        return back();
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
