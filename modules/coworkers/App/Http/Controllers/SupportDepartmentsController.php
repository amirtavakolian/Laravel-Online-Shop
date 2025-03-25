<?php

namespace Coworkers\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Coworkers\App\Http\Requests\DepartmentsResource;
use Coworkers\App\Http\Requests\SupportCoworkersResource;
use Coworkers\App\Models\SupportDepartment;

class SupportDepartmentsController extends Controller
{

    public function departments()
    {
        return ApiResponseFacade::setData(DepartmentsResource::collection(SupportDepartment::all()))->build()->response();
    }

    public function departmentCoworkers(int $departmentId)
    {
        $supportDepartmentCoworkers = SupportDepartment::find($departmentId)->coworkers;

        return ApiResponseFacade::setData(SupportCoworkersResource::collection($supportDepartmentCoworkers))->build()->response();
    }
}
