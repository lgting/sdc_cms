<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Column;
use App\Models\Model;
use App\Models\Field;
use App\Http\Requests\Articles\PostRequest;
use App\Http\Requests\Articles\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{
    protected $name = 'articles';
    public function __construct(){
        parent::__construct();
        view()->share('attributesOptions',Article::AttributesOptions);
        view()->share('columnsOptions',Column::treeOptions());
        view()->share('modelsOptions',Model::get()->pluck('name','id')->toArray());
    }

    public function upload(Request $request){
        $file = $request->file;
        $baseDir = storage_path('app'.'/'.config('filesystems.default'));
        $dirPath = "{$this->name}/" . date("Ymd");
        if (! file_exists($baseDir.'/'.$dirPath)){
            mkdir($baseDir.'/'.$dirPath);
        }
        $fileName =  Str::random(10) .'.' . $file->extension(); 
        $image = \Image::make($file);
        $imageWidth = $image->width();
        $imageHeight = $image->height();
        $fontSize = config('admin.thumb.font.size');
        switch(config('admin.thumb.position')){
            case 'center':
                $imageY = ($imageHeight/2) - ($fontSize/2);
                $imageX = $imageWidth /2;
                $align = 'center';
            break;
            case 'bottom-left':
                $imageY = $imageHeight - ($fontSize/2);
                $imageX = $imageWidth /2;
                $align = 'left';
            break;
            case 'bottom-right':
                $imageY = $imageHeight - ($fontSize/2);
                $imageX = $imageWidth /2;
                $align = 'right';
            break;
            case 'top-right':
                $imageY = $fontSize+5;
                $imageX = $imageWidth /2;
                $align = 'right';
            break;
            case 'top-left':
                $imageY = $fontSize+5;
                $imageX = $imageWidth /2;
                $align = 'left';
            break;
            default:
                $imageY = $imageHeight - ($fontSize/2);
                $imageX = $imageWidth /2;
                $align = 'left';

        }
        // 添加文字水印
        $image->text(config('admin.thumb.text'),$imageX,$imageY,function ($font) use ($align){
            $font->file(storage_path('fonts'.'/'.config('admin.thumb.font.ttf')));
            $font->size(config('admin.thumb.font.size'));
            $font->color(config('admin.thumb.font.color'));
            $font->align($align);
        });
        $image->save($baseDir.'/'.$dirPath.'/'.$fileName,30);
        return response()->json([
            "code"=>201,
            "msg"=>__('admin.uploaded_success'),
            "data"=>[
                'src'=>$dirPath.'/'.$fileName
            ]
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Column $column)
    {
        $pagination = Article::where('column_id',$column->id)->orderBy('id','desc')->paginate(config('admin.view.page_count'));
        return view("{$this->adminViewPrefix}.{$this->name}.index",[
            'pagination'=>$pagination,
            'column'=>$column
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Column $column)
    {
        $additionalFields = Field::where('model_id',$column->model_id)->get();
        return view("{$this->adminViewPrefix}.{$this->name}.create",[
            'additionalFields'=>$additionalFields,
            'column'=>$column
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request,Column $column,Model $model)
    {
        $articlesForm = $request->except(['additional_fields','file','_method','attributes']);
        $additionalFields = $request->additional_fields;
        if(! empty($additionalFields)){
            foreach($additionalFields as $additionalFieldsKey => $additionalFieldsValue){
                if(is_array($additionalFieldsValue)){
                    $additionalFields[$additionalFieldsKey] = implode('|',array_keys($additionalFieldsValue));
                }
            }
        }
        $articlesForm['model_id'] = $model->id;
        $articlesForm['column_id'] = $column->id;
        $articlesForm['attributes'] = implode('|',array_keys($request->input('attributes')));
        $article = Article::create($articlesForm);
        $additionalFields['article_id'] = $article->id;
        DB::table($model->table_name)->insert($additionalFields);
        return $this->createdResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $model = Model::findOrFail($article->model_id);
        $additionalModel = DB::table($model->table_name)->where('article_id',$article->id)->first();
        if(! $additionalModel)
            abort(404);
        $additionalFields = Field::where('model_id',$article->model_id)->get();
        return view("{$this->adminViewPrefix}.{$this->name}.edit",[
            'additionalFields'=>$additionalFields,
            'article'=>$article,
            'additionalModel'=>(array) $additionalModel
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Article $article)
    {
        $articlesForm = $request->except(['additional_fields','file','_method','attributes']);
        $additionalFields = $request->additional_fields;
        $model = Model::findOrFail($article->model_id);
        foreach($additionalFields as $additionalFieldsKey => $additionalFieldsValue){
            if(is_array($additionalFieldsValue)){
                $additionalFields[$additionalFieldsKey] = implode('|',array_keys($additionalFieldsValue));
            }
        }
        $articlesForm['attributes'] = implode('|',array_keys($request->input('attributes')));
        $article->update($articlesForm);
        DB::table($model->table_name)->where('article_id',$article->id)->update($additionalFields);
        return $this->updatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
