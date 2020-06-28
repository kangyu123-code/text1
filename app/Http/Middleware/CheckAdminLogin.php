<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminLogin
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
        if(!auth()->check()){

            return redirect(route('admin.login'))->withErrors(['error'=>'请登录']);
        } 
        if(auth()->user()->username!=env('SUPER')){
        $auths=array_filter(session('admin.auth'));
        $auths[]='admin.index';
        $auths[]='admin.logout';
        $dangqian=$request->route()->getName();
        if(!in_array($dangqian, $auths)){
            exit('你没有权限');
        }
        $request->auths=$auths;
        } 
      
        return $next($request);
    }
}
