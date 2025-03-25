<?php

namespace Coworkers\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Coworker extends Authenticatable
{
    use HasFactory, HasRoles, HasApiTokens, Notifiable;

    protected $guarded = [];

    public function supportDepartments()
    {
        return $this->belongsToMany(SupportDepartment::class, 'coworker_support_department');
    }

    public function getFullnameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
