<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    // 和 Question model 建立一對多關係

    public function question()
    {
        return $this->belongsTo('App\Question');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
