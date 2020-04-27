<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    protected $fillable = ['user_id','bonus_type_id','status','text','balance'];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
