<?php

namespace Coworkers\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Coworkers\App\Http\Requests\AddCoworkerToDepartmentsRequest;
use Coworkers\App\Models\Coworker;

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
