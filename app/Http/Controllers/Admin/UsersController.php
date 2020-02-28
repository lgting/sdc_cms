<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\LoginsRequest;
use App\Http\Requests\Users\UpdateMineRequest;
use App\Http\Requests\Users\PostRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class UsersController extends Controller
{
    protected $name = 'users';

    public function __construct(){
        parent::__construct();
        view()->share('rolesOptions',Role::orderBy('id','desc')->get()->pluck('name')->toArray());
        view()->share('permissionsOptions',Permission::orderBy('id','desc')->get()->pluck('name')->toArray());
    }

    public function index(){
        $pagination = User::orderBy('id','desc')->paginate(config('admin.view.page_count'));
        return view("{$this->adminViewPrefix}.{$this->name}.index",[
            'pagination'=>$pagination
        ]);
    }

    public function create(){
        return view("{$this->adminViewPrefix}.{$this->name}.create");
    }

    public function store(PostRequest $request){
        $form = $request->only(['name','nickname','password']);
        $form['password'] = bcrypt($form['password']);
        $user = User::create($form);
        // give by user roles
        if($request->roles){
            $roles = array_keys($request->roles);
            $user->syncRoles($roles);
        }
        // give by user permissions
        if($request->permissions){
            $permissions = array_keys($request->permissions);
            $user->syncPermissions($permissions);
        }
        return $this->createdResponse();
    }

    public function edit(User $user){
        $userPermissions = $user->getAllPermissions()->pluck('name')->toArray();
        $userRoles = $user->getRoleNames()->toArray();
        return view("{$this->adminViewPrefix}.{$this->name}.edit",[
            'item'=>$user,
            'userPermissions'=>$userPermissions,
            'userRoles'=>$userRoles
        ]);
    }

    public function update(UpdateRequest $request,User $user){
        $form = $request->all();
        $update['name'] = $form['name'];
        $update['nickname'] = $form['nickname'];
        if($request->roles){
            $roles = array_keys($request->roles);
            $user->syncRoles($roles);
        }else{
            $user->syncRoles([]);
        }
        if($request->permissions){
            $permissions = array_keys($request->permissions);
            $user->syncPermissions($permissions);
        }else{
            $user->syncPermissions([]);
        }
        if($form['password'])
            $update['password'] = bcrypt($form['password']);
        $user->update($update);
        return $this->updatedResponse(); 
    }

    public function destroy(User $user){
        if ($user->name == 'admin'){
            return response()->json([
                'status'=>500,
                'message'=>trans('users.can not delete manager'),
            ]);
        }
        $user->delete();
        return $this->deletedResponse();
    }

    public function loginView(){
        return view("{$this->adminViewPrefix}.{$this->name}.login");
    }

    public function loginAction(LoginsRequest $request){
        $credentials = $request->only(['name','password']);
        if(! Auth::attempt($credentials)){
            return response()->json([
                'status'=>404,
                'message'=>trans('users.password error'),
            ]);
        }
        return response()->json([
            'status'=>201,
            'message'=>trans('users.login success'),
            'redirect_url'=>route('admin.indexs.index')
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.users.login_view');
    }

    public function editMine(){
        $currentUser = Auth::user();
        return view("{$this->adminViewPrefix}.{$this->name}.edit_mine",[
            'currentUser'=>$currentUser
        ]);
    }

    public function updateMine(UpdateMineRequest $request){
        $form = $request->all();
        $update = [];
        if ($form['password']){
            $update['password'] = bcrypt($form['password']);
        }
        $update['nickname'] = $form['nickname'];
        Auth::user()->update($update);
        Auth::logout();
        return response()->json([
            'status'=>201,
            'message'=>trans('users.update success'),
            'redirect_url'=>route('admin.users.login_view')
        ]);
    }
}
