<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Service\UserServices;

class UsersController extends ApiController
{
    protected $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function getUserList()
    {
        return $this->userServices->list()->toArray();
    }

}
