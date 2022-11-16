<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use DataTables;
class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
            $activities = Activity::where('model_name','App\Models\Showroom')->latest()->paginate(10);
            return view('showrooms/activity',compact('activities'));
            //
       
    }


    public function list(Request $request)
    {
        if ($request->ajax()) {
            $activities = Activity::all();
         
            return DataTables::of($activities)
                ->addIndexColumn()
               
                ->addColumn('user_name', function($row){
                    $actionBtn = ' <a href="#" class="text-primary">'.$row->user_name.'<i class="fas fa-user mx-2"></i></a>
               
               ';
                    return $actionBtn;
                })
                ->addColumn('description', function ($row) {

                    $actionBtn = '<a onclick="TransactionDetails(' . "'$row->model_id'" . ')"  href="javascript:void()" class="text-primary">
                    ' . $row->description . '
                </a>
               ';
                    return $actionBtn;
                })
                ->addColumn('created_at', function($row){
                    $created_at = $row->created_at->format('Y.m.d H:i:s');
                    return $created_at;
                })
                ->rawColumns(['description','user_name'])
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
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
