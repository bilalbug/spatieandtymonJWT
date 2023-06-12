<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Traits\HasPermissions;

class Role extends SpatieRole
{
    use HasPermissions, HasFactory, SoftDeletes;

    protected $fillable = [
        'id', // Add 'id' to the array
        'name',
        'guard_name',
    ];
}
