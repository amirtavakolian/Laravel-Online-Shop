<?php

namespace App\Http\Controllers\SupportDepartments;

use App\Http\Controllers\Controller;
use App\Http\Resources\Departments\DepartmentsResource;
use App\Http\Resources\SupportCoworkers\SupportCoworkersResource;
use App\Models\SupportDepartment;
use App\Services\ApiResponse\ApiResponseFacade;

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
