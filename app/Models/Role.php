<?php

namespace App\Models;

use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
{
    public $guarded = [];

    public function users()
{
    return $this->belongsToMany(User::class, 'role_user');  // Relasi many-to-many
}

}


