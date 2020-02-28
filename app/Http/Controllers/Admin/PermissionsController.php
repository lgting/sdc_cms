<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Requests\Permissions\PostRequest;
use App\Http\Requests\Permissions\UpdateRequest;

class PermissionsController extends Controller
{
    protected $name = 'permissions';
    public function __construct(){
        parent::__construct();
        view()->share('httpMothedsOptions',Permission::HttpMothedsOptions);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = Permission::paginate(config('admin.view.page_count'));
        return view("{$this->adminViewPrefix}.{$this->name}.index",[
            'pagination'=>$pagination
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
        $form = $request->all();
        if($form['http_methods']){
            $form['http_methods'] = implode('|',array_keys($form['http_methods']));
        }
        Permission::create($form);
        return $this->createdResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spatie\Permission\Model\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spatie\Permission\Model\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view("{$this->adminViewPrefix}.{$this->name}.edit",[
            'item'=>$permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spatie\Permission\Model\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Permission $permission)
    {
        $form = $request->all();
        if($form['http_methods']){
            $form['http_methods'] = implode('|',array_keys($form['http_methods']));
        }
        $permission->update($form);
        return $this->updatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spatie\Permission\Model\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return $this->deletedResponse();
    }
}
