<?php

namespace App\Http\Controllers\Admin;

use App\Models\Model;
use App\Http\Requests\Models\PostRequest;
use App\Http\Requests\Models\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ModelsController extends Controller
{
    protected $name = 'models';

    public function __construct(){
        parent::__construct();
        view()->share('statusOptions',Model::StatusOptions);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = Model::paginate(config('admin.view.page_count'));
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
        Model::create($form);
        Schema::create($form['table_name'],function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('article_id')->comment(__('models.article id'));
        });
        return $this->createdResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model  $model
     * @return \Illuminate\Http\Response
     */
    public function show(Model $model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model  $model
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $model)
    {
        return view("{$this->adminViewPrefix}.{$this->name}.edit",[
            'item'=>$model
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Model  $model
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Model $model)
    {
        $form = $request->all();
        if(! hash_equals($form['table'],$model->table)){
            Schema::rename($model->table,$form['table']);
        }
        $model->update($form);
        return $this->updatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model  $model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $model)
    {
        Schema::dropIfExists($model->table);
        $model->delete();
        return $this->deletedResponse();
    }
}
