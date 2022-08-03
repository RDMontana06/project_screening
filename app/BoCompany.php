<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoCompany extends Model
{
    protected $table = 'bo_companies';

    public function user(){
        return $this->belongsTo(User::class,'created_by', 'id');
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
