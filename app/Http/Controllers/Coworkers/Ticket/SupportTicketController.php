<?php

namespace App\Http\Controllers\Coworkers\Ticket;

use App\Http\Controllers\Controller;
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

}
