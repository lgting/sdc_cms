<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    public $adminViewPrefix = '';
    public function __construct(){
        $this->adminViewPrefix = config('admin.view.prefix') ;
        view()->share('currentUser',Auth::user());
        Paginator::defaultView('pagination::simple-default');
    }

    public function createdResponse(){
        return response()->json([
            'status'=>201,
            'message'=>__('admin.created_response')
        ]);
    }

    public function deletedResponse(){
        return response()->json([
            'status'=>204,
            'message'=>__('admin.deleted_response')
        ]);
    }
    public function updatedResponse(){
        return response()->json([
            'status'=>200,
            'message'=>__('admin.updated_response')
        ]);
    }
}
