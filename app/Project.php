<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    public function contact(){
        return $this->hasMany(Contact::class);
    }
    public function attachment(){
        return $this->hasMany(Attachment::class);
    }
    public function bo_companies(){
        return $this->hasMany(BoCompany::class)->orderBy('id', 'desc');
    }
    // public static function boot(){
    //     parent::boot();
    //     static::creating(function($project){
    //         $project->id = $project->id + 1;
    //         $latestProject = App\Project::orderBy('created_at','DESC')->first();
    //         $project->ref_code = 'PSF' . '-' . str_pad($project->id, 5, '0', STR_PAD_LEFT);
    //     });
    // }
}
