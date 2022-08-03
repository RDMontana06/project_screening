<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    public function attachment(){
        return $this->hasMany(PaymentAttachment::class);
    }
    public function bo_companies(){
        return $this->belongsTo(BoCompany::class);
    }

    
}
