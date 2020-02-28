<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Configs\PostRequest;
use App\Http\Requests\Configs\UpdateRequest;
use App\Models\Config;

class ConfigsController extends Controller
{
    protected $name = 'configs';

    public function __construct(){
        parent::__construct();
        view()->share('configTypeOptions',Config::ConfigTypeOptions);
        view()->share('dataTypeOptions',Config::DataTypeOptions);
    }

    public function editConfig(){
        $items = Config::all();
        return view("{$this->adminViewPrefix}.{$this->name}.edit_config",[
            'items'=>$items
        ]);
    }

    public function saveConfig(Request $request){
        $forms = $request->all();
        foreach($forms as $formsKey => $formsValue){
            if(is_array($formsValue))
            {
                $formsValue = implode('|',array_keys($formsValue));
            }
            Config::where('en_name',$formsKey)->update(['value'=>$formsValue]);
        }
        return $this->updatedResponse();
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
        $pagination = Config::paginate(config('admin.view.page_count'));
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
        Config::create($request->all());
        return $this->createdResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Config $config)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Config $config)
    {
        return view("{$this->adminViewPrefix}.{$this->name}.edit",[
            'item'=>$config
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request,Config $config)
    {
        $config->update($request->all());
        return $this->updatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        $config->delete();
        return $this->deletedResponse();
    }
}
