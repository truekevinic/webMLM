<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function users(){
        return $this->belongsTo(User::class);
    }
}
