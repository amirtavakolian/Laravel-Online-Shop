<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\User\StoreTicketRequest;
use App\Http\Requests\Ticket\User\UpdateTicketRequest;
use App\Http\Requests\Ticket\User\UserCloseTicketRequest;
use App\Http\Requests\Ticket\User\UserTicketAnswerRequest;
use App\Http\Resources\Ticket\TicketResource;
use App\Models\Ticket;
use App\Services\ApiResponse\ApiResponseFacade;
use App\Services\Ticket\TicketService;
use Authentication\App\Models\User;
use Coworkers\App\Models\SupportDepartment;

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

    public function destroy(Ticket $ticket)
    {
        $this->authorize('destroy', $ticket);

        $ticket->delete();

        return ApiResponseFacade::setMessage(__('messages.tickets.ticket_has_deleted_successfully'))->build()->response();
    }

    public function answer(UserTicketAnswerRequest $request, Ticket $ticket)
    {
        $this->authorize('answer', $ticket);

        $this->ticketService->userAnswer($request, $ticket);

        return ApiResponseFacade::setMessage(__('messages.tickets.your_ticket_submited_successfully'))->build()->response();

    }

    public function close(UserCloseTicketRequest $request, Ticket $ticket)
    {
        $this->authorize('close', $ticket);

        if(!is_null($ticket->closed_at)){
            return ApiResponseFacade::setMessage(__('messages.tickets.ticket_is_closed'))->build()->response();
        }

        $ticket->update([
            'satisfaction_rate' => $request->input('satisfaction_rate'),
            'closed_at' => now()
        ]);

        return ApiResponseFacade::setMessage(__('messages.tickets.ticket_closed_successfully'))->build()->response();
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->update($request->validated());

        return ApiResponseFacade::setMessage(__('messages.tickets.ticket_has_updated_successfully'))->build()->response();
    }

}
