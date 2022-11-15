<?php

namespace App\Http\Controllers\admin;
use App\Models\Activity;
use App\Models\User;
use App\Models\Showroom;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use DataTables;
use DB;
class UserController extends Controller
{
    function __construct()
    {
        
    }

    public function index(Request $request)
    {
        $activities = Activity::where('model_name','App\Models\User')->latest()->paginate(10);
        $data = User::orderBy('id', 'desc')->get();
        // dd($data);
        return view('users.index',compact('activities'));
    }


    public function userlist(Request $request)
    {
        if ($request->ajax()) {
            $users = User::orderBy('id', 'desc')->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if(Auth::user()->can('Edit User')){
                    $actionBtn = '
                     <a onclick="UserEdit('."'$row->id'".')"  href="javascript:void()" class="btn btn-primary btn-sm text-white">
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
        $list = User::orderBy('id', 'desc')->paginate(10);
        
        return view("users/table", compact('list'));
    }

    public function unauthorise()
    {
        return response()->json([
            'message' => "New token required",
            'statusCode' => 403,
        ], 403);
    }


    public function login(Request $request)
    {

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/admin/dashboard');
        }else{
            return back()->withInput($request->only('email', 'remember'));
        }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm()
    {
        return view('admin/admin');
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $list = Showroom::all();
        return view('users/create',compact('list','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'showroom' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        if($user){
            Activity::activityCreate('App\Models\User','User created',$user->id);    
        }
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users')
            ->with('success', 'User created successfully.');
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
        $list = Showroom::all();
         $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
     
        return view('users/edit',compact('user','roles','userRole','list'));
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
            'phone' => 'required',
            
            'password' => 'required|confirmed',
            
        ]);
        $input = $request->all();
        
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
        Activity::activityCreate('App\Models\User','User Updated',$user->id);
        return redirect()->route('users')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function logout(Request $request)
    {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/admin/admin');
    }
}
