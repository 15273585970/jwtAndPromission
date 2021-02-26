<?php

namespace App\Http\Middleware;

use App\Service\UserServices;
use Closure;
use http\Env\Response;

class CheckAuthToken
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
        //先判断请求头是否携带token
        $token = $request->header('token');
        if (empty($token)) {
            return Response()->json(['msg' => '未授权访问']);
        }
        $userServices = new UserServices();
        $check_result = $userServices->checkToken($token);
        if (is_bool($check_result)) {
            return Response()->json(['msg' => '未授权访问']);
        }
        //将用户部分数据存放在请求资源中
        $request->attributes->add(['users'=>$check_result]);
        //验证token是否正确
        return $next($request);
    }
}
