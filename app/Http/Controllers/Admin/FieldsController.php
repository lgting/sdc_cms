<?php

namespace App\Http\Controllers\Admin;

use App\Models\Field;
use App\Models\Model;
use App\Http\Requests\Fields\PostRequest;
use App\Http\Requests\Fields\UpdateRequest;
use Illuminate\Http\Request;

class FieldsController extends Controller
{
    protected $name = 'fields';
    public function __construct(){
        parent::__construct();
        view()->share('typeOptions',Field::TypeOptions);
        view()->share('modelOptions',Model::get()->pluck('name','id')->toArray());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = Field::paginate(config('admin.view.page_count'));
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
        Field::addField($form);
        Field::create($form);
        return $this->createdResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Field $field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(Field $field)
    {
        return view("{$this->adminViewPrefix}.{$this->name}.edit",[
            'item'=>$field
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Field $field)
    {
        $form = $request->all();
        $model = Model::where('id',$field->model_id) ->first();
        if ($form['en_name'] != $field->en_name){
            Field::renameField($model->table_name,$field->en_name,$form['en_name']);
        }
        if($form['type'] != $field->type){
            Field::changeField($form);
        }
        $field->update($form);
        return $this->updatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field)
    {
        $model = Model::where('id',$field->model_id)->first();
        Field::deleteField($model->table_name,$field->en_name);
        $field->delete();
        return $this->deletedResponse();
    }
}
