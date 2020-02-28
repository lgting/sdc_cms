<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\Menus\PostRequest;
use App\Http\Requests\Menus\UpdateRequest;

class MenusController extends Controller
{
    protected $name = 'menus';

    public function __construct(){
        parent::__construct();
        view()->share('rolesOptions',Role::orderBy('id','desc')->get()->pluck('name')->toArray());
        view()->share('permissionsOptions',Permission::orderBy('id','desc')->get()->pluck('name')->toArray());
        view()->share('menusOptions',Menu::tree());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view("{$this->adminViewPrefix}.{$this->name}.index",[
            'menus'=>$menus
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
        $form = $request->only(['title','uri','icon','sortable','parent_id']);
        if($request->permissions){
            $form['permission'] = implode('|',array_keys($request->permissions));
        }
        $menu = Menu::create($form);
        if($request->roles){
            $roles = collect(array_keys($request->roles))->map(function ($roleName){
                $role = Role::where('name',$roleName)->first();
                if(!$role)
                    return false;
                return $role->id;
            })->toArray();
            $menu->roles()->sync($roles);
        }
        return $this->createdResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view("{$this->adminViewPrefix}.{$this->name}.edit",[
            'item'=>$menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $form = $request->only(['title','icon','sortable','parent_id','uri']);
        if($request->permissions){
            $form['permission'] = implode('|',array_keys($request->permissions));
        }
        if($request->roles){
            $roles = collect(array_keys($request->roles))->map(function ($roleName){
                $role = Role::where('name',$roleName)->first();
                if(! $role)
                    return false;
                return $role->id;
            });
            $menu->roles()->sync($roles);
        }else{
            $menu->roles()->sync([]);
        }
        $menu->update($form);
        return $this->updatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if(Menu::where('parent_id',$menu->id)->count() > 0 || $menu->id == 1){
            return response()->json([
                'status'=>500,
                'message'=>trans('menus.can not delete')
            ]);
        }
        $menu->delete();
        return $this->deletedResponse();
    }
}
