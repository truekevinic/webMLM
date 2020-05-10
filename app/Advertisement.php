<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = ['user_id', 'link', 'description', 'image-source'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
