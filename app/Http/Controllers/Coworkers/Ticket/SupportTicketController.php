<?php

namespace App\Http\Controllers\Coworkers\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\Coworker\AssignTicketRequest;
use App\Http\Requests\Ticket\Coworker\AssignTicketToDepartmentRequest;
use App\Http\Requests\Ticket\Coworker\SupportCoworkerAnswerTicketRequest;
use App\Http\Resources\Ticket\TicketResource;
use App\Models\Ticket;
use App\Services\ApiResponse\ApiResponseFacade;
use App\Services\Ticket\TicketService;

class SupportTicketController extends Controller
{
    public function __construct(private TicketService $ticketService)
    {
    }

    public function index()
    {
        $this->authorize('supportCoworkersViewAny', Ticket::class);

        $tickets = $this->ticketService->all();

        return ApiResponseFacade::setData(TicketResource::collection($tickets))->build()->response();
    }

    public function show(Ticket $support_ticket)
    {
        $this->authorize('supportCoworkersViewAny', Ticket::class);

        $message = $this->ticketService->open($support_ticket);

        if (!is_string($message)) {
            return ApiResponseFacade::setData($support_ticket)->build()->response();
        }

        return ApiResponseFacade::setMessage($message)->build()->response();
    }

    public function store(SupportCoworkerAnswerTicketRequest $request)
    {
        $this->ticketService->supportCoworkerAnswer($request);

        return ApiResponseFacade::setMessage(__('messages.tickets.your_answer_submitted_successfully'))
            ->build()->response();
    }

    public function assign(AssignTicketRequest $request)
    {
        $this->authorize('supportCoworkersViewAny', Ticket::class);

        $result = $this->ticketService->assign($request);

        return ApiResponseFacade::setMessage(is_string($result) ? $result : __('messages.tickets.ticket_succesfully_assigned_to_another_coworker'))
            ->build()->response();
    }

    public function assignToDepartment(AssignTicketToDepartmentRequest $request)
    {
        $this->authorize('supportCoworkersViewAny', Ticket::class);

        $result = $this->ticketService->assignToDepartment($request);

        return ApiResponseFacade::setMessage(is_string($result) ? $result : __('messages.tickets.ticket_succesfully_assigned_to_another_department'))
            ->build()->response();
    }

}
