<?php

namespace App\Http\Middleware;

use Closure;
use http\Env\Response;
use App\Http\Controllers\auth\CheckPromissionControoler;
use http\Url;

class CheckUserPromission
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
        if (!$request->get('users')) {
            return Response()->json(['msg' => '未授权访问']);
        }
        $check  = new CheckPromissionControoler();
        //获取当前访问路由地址
        $url = $request->path();
//        //返回用户可访问模块
//        $menu = $check->checkMenu($request->get('users'), $url);
//        if (!is_numeric($menu)) {
//            return Response()->json(['msg' => '没有模块访问权限','status' => 500]);
//        }
        $result = $check->checkUserPromission($request->get('users'), $url);
        if (!is_numeric($result)) {
            return Response()->json(['msg' => $result,'status' => 500]);
        }
        
        return $next($request);
    }
}
