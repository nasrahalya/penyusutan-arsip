<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller 
{ 
    function __construct()
    {
        $this->middleware(
            'permission:user-list|user-create|user-edit|user-delete',
            ['only' => ['index', 'show']]
        );
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    } 
    public function index(Request $request) 
    { 
        if ($request->ajax()) {
            $data = User::with('roles')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if (Auth::user()->can('user-edit')) {
                        $actionBtn = '<a href="' . route('users.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if (Auth::user()->can('user-edit')) {
                        $actionBtn .= '<a href="' . route('users.show', $row->id) . '" class="delete btn btn-primary btn-sm">Show</a>';
                    }
                    if (Auth::user()->can('user-edit')) {
                        $actionBtn .= '<form action="' . route('users.destroy', $row->id) . '" method="POST" class="d-inline">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="delete btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this product?\')">Delete</button>
                    </form>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view(('users.index'));
    } 
     
    /** 
     * Show the form for creating a new resource. 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function create() 
    { 

        $roles = Role::pluck('name','name')->all(); 
        return view('users.create',compact('roles')); 
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
            'email' => 'required|email|unique:users,email', 
            'password' => 'required|same:confirm-password', 
            'roles' => 'required' 
        ]); 
     
        $input = $request->all(); 
        $input['password'] = Hash::make($input['password']); 
     
        $user = User::create($input); 
        $user->assignRole($request->input('roles')); 
     
        return redirect()->route('users.index') 
                        ->with('success','User created successfully'); 
    } 
     
    /** 
     * Display the specified resource. 
     * 
     * @param  int  $id 
     * @return \Illuminate\Http\Response 
     */ 
    public function show($id) 
    { 
        $user = User::find($id); 
        return view('users.show',compact('user')); 
    } 
     
    /** 
     * Show the form for editing the specified resource. 
     * 
     * @param  int  $id 
     * @return \Illuminate\Http\Response 
     */ 
    public function edit($id) 
    { 
        $user = User::find($id); 
        $roles = Role::pluck('name','name')->all(); 
        $userRole = $user->roles->pluck('name','name')->all(); 
     
        return view('users.edit',compact('user','roles','userRole')); 
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
            'email' => 'required|email|unique:users,email,'.$id, 
            'password' => 'same:confirm-password', 
            'roles' => 'required' 
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
     
        return redirect()->route('users.index') 
                        ->with('success','User updated successfully'); 
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
} 
