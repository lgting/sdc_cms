<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Roles\PostRequest;
use App\Http\Requests\Roles\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RolesController extends Controller
{
    protected $name = 'roles';

    public function __construct(){
        parent::__construct();
        view()->share('permissionsOptions',Permission::orderBy('id','desc')->get()->pluck('name')->toArray());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = Role::paginate(config('admin.view.page_count'));
        return view("{$this->adminViewPrefix}.{$this->name}.index",[
            'pagination' => $pagination
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("{$this->adminViewPrefix}.{$this->name}.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $form = $request->only(['name']);
        $role = Role::create($form);
        if($request->permissions){
            $permissions = array_keys($request->permissions);
            $role->syncPermissions($permissions);
        }
        return $this->createdResponse();
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
    public function edit(Role $role)
    {
        $roleAsPermissions = $role->permissions()->pluck('name')->toArray();
        return view("{$this->adminViewPrefix}.{$this->name}.edit",[
            'item'=>$role,
            'roleAsPermissions'=>$roleAsPermissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Role $role)
    {
        $form = $request->only(['name']);
        $role->update($form);
        if($request->permissions){
            $permissions = array_keys($request->permissions);
            $role->syncPermissions($permissions);
        }else{
            $role->syncPermissions([]);
        }
        return $this->updatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return $this->deletedResponse();
    }
}
