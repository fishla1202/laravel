<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anser extends Model
{
    //和 question model 建立多對一關係
    public function question() {
        return $this->belongsTo('App\Question');
    }
}
