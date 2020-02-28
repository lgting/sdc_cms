<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Column;
use App\Models\Config;
use App\Models\Model;
use App\Http\Requests\Columns\PostRequest;

class ColumnsController extends Controller
{
    protected $name = 'columns';

    public function __construct(){
        parent::__construct();
        view()->share('statusOptions',Column::StatusOptions);
        view()->share('attributesOptions',Column::AttributesOptions);
        view()->share('columns',Column::treeOptions());
        view()->share('modelsOptions',Model::get()->pluck('name','id')->toArray());
    }

    public function upload(Request $request){
        $file = $request->file;
        $dirPath = "{$this->name}/" . date("Ymd");
        $fileName =  Str::random(10) .'.' . $file->extension(); 
        $uploadeddFile = $file->storeAs($dirPath,$fileName,config('filesystems.default'));
        return response()->json([
            "code"=>201,
            "msg"=>__('admin.uploaded_success'),
            "data"=>[
                'src'=>$uploadeddFile
            ]
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = Column::all();
        return view("{$this->adminViewPrefix}.{$this->name}.index",compact('columns'));
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
        Column::create($request->all());
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
    public function edit(Column $column)
    {
        return view("{$this->adminViewPrefix}.{$this->name}.edit",['item'=>$column]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Column $column)
    {
        $column->update($request->all());
        return $this->updatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Column $column)
    {
        $count = Column::where('parent_id',$column->id)->count();
        if($count >= 1){
            return response()->json([
                'status' => 500,
                'message'=>__('columns.can_not_delete')
            ]);
        }
        $column->delete();
        return $this->deletedResponse();
    }
}
