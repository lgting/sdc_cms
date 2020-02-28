<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as BasePermission;
use Illuminate\Support\Str;

class Permission extends BasePermission
{
    const HttpMothedsOptions = [
        'GET'=>'查看',
        'POST'=>'创建',
        'PATCH'=>'修改',
        'DELETE'=>'删除',
    ];

    public function shouldPassThrowgh($request) : bool
    {
        $method = $this->http_methods;
        $path = $this->http_paths;
        if (empty($method) && empty($path))
            return true;
        $matchs = array_map(function ($path) use($method){
            $path = admin_route_prefix().$path;
            if(Str::contains($path,':')){
                list($method,$path) = explode(':',$path);
                $method = explode('|',$method);
            }
            if (! is_array($method))
                $method = explode('|',$method);
            return compact('path','method');
        },explode("\n",$path));
        foreach($matchs as $match){
           if($this->matchRequest($match,$request)){
               return true;
           }
        }
        return false;
    }

    public function matchRequest($match,$request) : bool{
        if($match['path'] == '/'){
            $path = $match['path'];
        }else{
            $path = trim($match['path'],'/');
        }
        if(!$request->is($path))
            return false;

        $method = collect($match['method'])->filter()->map(function ($method){
            return strtoupper($method);
        });

        return $method->isEmpty() || $method->contains($request->method());
    }
}
