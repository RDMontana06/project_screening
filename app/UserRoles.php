<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    //
    public function roles()
    {
        return $this->belongsTo(Roles::Class, 'role_id', 'id');
    }
}
