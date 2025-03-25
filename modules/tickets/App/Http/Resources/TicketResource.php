<?php

namespace Tickets\App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title" => $this->title,
            "content" => $this->content,
            "user_id" => $this->user->fullname,
            "support_department_id" => $this->supportDepartment->name,
            "is_opened" => !($this->is_opened == 0),
            "opened_by" => is_null($this->opened_by) ? 'باز نشده' : $this->coworker->fullname,
            "status" => $this->status,
            "priority" => $this->priority,
            "created_at" => Carbon::parse($this->created_at)->diffForHumans(),
            "updated_at" => Carbon::parse($this->updated_at)->diffForHumans(),
        ];
    }
}


