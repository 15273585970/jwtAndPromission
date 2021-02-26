<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\ApiController;
use App\Models\users\Promissionss;
use App\Models\users\RolePromissionAssioc;
use App\Models\users\UsersPromissionAssioc;
use App\Models\users\UsersRoleAssioc;
use http\Env\Response;

class CheckPromissionControoler extends ApiController
{
    /**
     * 检测用户是否拥有权限
     * @param $user
     * @param $url
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function checkUserPromission($user, $url)
    {
        //用户是否直接有权限 所有权限*
        $u_id = $user->id;
        //权限id
        $promission = Promissionss::where('url',$url)->first();
        $p_id = $promission['id'];
        if (empty($p_id)) {
            return $this->fail('',500,'请输入正确的访问地址');
        }
        //用户与权限的直接关系
        $upAssioc = UsersPromissionAssioc::where('u_id',$u_id)->pluck('p_id');
        if ($upAssioc->isEmpty()) {
            //用户是否属于某个角色
            $result = $this->checkUserRole($u_id, $p_id);
            if (!is_numeric($result)) {
                return $this->fail('',500,'无访问权限3');
            }
        } else {
            $upAssioc = $upAssioc->toArray();
            if (!in_array($p_id,$upAssioc)) {
                return $this->fail('',500,'无访问权限2');
            }
            return 1;
        }
        return 1;
    }

    /**
     * 检测用户属于什么角色
     * @param $u_id 用户id
     * @param $p_id 角色id
     */
    public function checkUserRole($u_id, $p_id)
    {
        //查询用户所属所有角色
        $r_ids = UsersRoleAssioc::where('u_id',$u_id)->pluck('r_id');
        if (empty($r_ids)) {
            return false;
        }
        //根据角色查询权限
        $p_ids = RolePromissionAssioc::whereIn('r_id',$r_ids)->select('p_id')->get();
        if ($p_ids->isEmpty()) {
            return false;
        }
        $new_pids = [];
        foreach($p_ids->toArray() as $id){
            $new_pids[] = $id['p_id'];
        }
        if (!in_array($p_id,$new_pids)) {
            return false;
        }
        return 1;
    }
}
