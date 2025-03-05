<?php

namespace App\Http\Controllers\Coworkers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Coworkers\AddCoworkerToDepartmentsRequest;
use App\Models\Coworker;
use App\Services\ApiResponse\ApiResponseFacade;

class CoworkersController extends Controller
{

    public function addToSupportDepartments(AddCoworkerToDepartmentsRequest $request)
    {
        $this->authorize('addCoworkerToDepartments', Coworker::class);

        $coworker = Coworker::query()->find($request->validated('coworker_id'));

        $coworker->supportDepartments()->sync($request->validated('support_department_id'));

        return ApiResponseFacade::setMessage(__('messages.coworkers.coworker_added_to_support_department'))
            ->build()->response();
    }
}
