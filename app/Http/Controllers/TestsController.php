<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class TestsController extends Controller
{
    protected $callback = null;
    public function test(){
        $self = new static();
        $column = \DB::getQueryGrammar()->wrap('sortable');
        $query = $column . '=0,'.$column;
        $result = Menu::toTree();
        dd($result);
    }
}
