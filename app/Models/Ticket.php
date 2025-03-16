<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supportDepartment()
    {
        return $this->belongsTo(SupportDepartment::class, 'support_department_id');
    }

    public function coworker()
    {
        return $this->belongsTo(Coworker::class, 'opened_by');
    }
}
