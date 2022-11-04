<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;
class RoleController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Role::orderBy('id','DESC')->paginate(5);
        $activities = Activity::where('model_name','Role')->latest()->paginate(10);
        return view('roles.index', compact('data','activities'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $users = Role::orderBy('id', 'desc')->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if(Auth::user()->can('Edit Role')){
                        $actionBtn = ' <a onclick="RoleEdit('."'$row->id'".')"  href="javascript:void()" class="btn btn-primary btn-sm text-white">
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();

        return view('roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(request()->all());
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    if($role){
        Activity::create(['user_id'=>Auth::user()->id,'user_name'=>Auth::user()->name,'showroom'=>Auth::user()->showroom,'description'=>"Role created",'model_id'=>$role->id,'model_name'=>'Role']);
    }
        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', 'permissions.id')
            ->where('role_has_permissions.role_id',$id)
            ->get();
    
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
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
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
        Activity::create(['user_id'=>Auth::user()->id,'user_name'=>Auth::user()->name,'showroom'=>Auth::user()->showroom,'description'=>"Role Updated",'model_id'=>$role->id,'model_name'=>'Role']);
        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role =Role::find($id);
        Activity::create(['user_id'=>Auth::user()->id,'user_name'=>Auth::user()->name,'showroom'=>Auth::user()->showroom,'description'=>"Role Deleted",'model_id'=>$role->id,'model_name'=>'Role']);
        $role->delete();
        
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}