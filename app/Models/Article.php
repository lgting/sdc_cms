<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = ['_token','_method'];

    const AttributesOptions = [
        0=>'普通',1=>'热门',2=>'加粗',3=>'幻灯片',4=>'置顶'
    ];
}
