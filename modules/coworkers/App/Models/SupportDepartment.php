<?php

namespace Coworkers\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportDepartment extends Model
{
    use HasFactory;

    public function coworkers()
    {
        return $this->belongsToMany(Coworker::class, 'coworker_support_department');
    }
}


