<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // 和 Answer model 建立一對多關係
    public function answers() {
        return $this->hasMany('App\Answer');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
}
