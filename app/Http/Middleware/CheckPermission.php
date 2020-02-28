<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(config('admin.permission.check') == false){
            return $next($request);
        }

        if($this->excepts($request)){
            return $next($request);
        }
        if($this->checkRoutePermission($request)){
            return $next($request);
        }
        if(! Auth::user()->getAllPermissions()->first(function ($permission) use ($request){
            return $permission->shouldPassThrowgh($request);
        })){
            abort(403, trans('admin.no permissions'));
        }
        return $next($request);
    }

    protected function checkRoutePermission($request){

        return false;
    }

    protected function excepts($request){
        $excepts = config('admin.permission.excepts',[
            '/login',
            '/logout',
        ]);
        return  collect($excepts)
                ->map('admin_route_prefix')
                ->contains(function ($except) use ($request){
                    if($except != '/'){
                        $except = trim($except,'/');
                    }
                    return $request->is($except);
                });
    }
}
