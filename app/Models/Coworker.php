<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Coworker extends Authenticatable
{
    use HasFactory, HasRoles, HasApiTokens;

    protected $guarded = [];

    public function supportDepartments()
    {
        return $this->belongsToMany(SupportDepartment::class, 'coworkers_support_departments');
    }
}
