<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexsController extends Controller
{
    protected $view = 'admin.indexs';

    public function index(){
        return view("{$this->view}.index");
    }

    public function welcome(){
        return view("{$this->view}.welcome");
    }

    public function destroyFile(Request $request){
        $fileName = $request->file_name;
        Storage::delete($fileName);
        return response()->json([
            'status'=>200,
            'message'=>__('admin.delete_file_success')
        ]);
    }
}
