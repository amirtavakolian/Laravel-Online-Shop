<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\User\StoreTicketRequest;
use App\Http\Requests\Ticket\User\UpdateTicketRequest;
use App\Http\Resources\Ticket\TicketResource;
use App\Models\SupportDepartment;
use App\Models\Ticket;
use App\Models\User;
use App\Services\ApiResponse\ApiResponseFacade;
use App\Services\Ticket\TicketService;

class TicketController extends Controller
{
    public function __construct(private TicketService $ticketService)
    {
    }

    public function index()
    {
        $tickets = Ticket::query()->where('user_id', auth()->user()->id)->get();

        return ApiResponseFacade::setData(TicketResource::collection($tickets))->build()->response();
    }

    public function store(StoreTicketRequest $request)
    {
        $this->ticketService->store($request->all());

        return ApiResponseFacade::setMessage(__('messages.tickets.ticket_created_successfully'))->build()->response();
    }

    public function userTicketHistoryCheck(User $userId, SupportDepartment $departmentId)
    {
        return ApiResponseFacade::setData([
            'status' => $this->ticketService->userTicketHistoryCheck($userId, $departmentId)
        ])->build()->response();
    }

    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        return ApiResponseFacade::setData(new TicketResource($ticket))->build()->response();
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->update($request->validated());

        return ApiResponseFacade::setMessage(__('messages.tickets.ticket_has_updated_successfully'))->build()->response();
    }

}
