<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function routeNotificationForNexmo() {
        return $this->phone;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    // 創造虛擬欄位 可放入多個到陣列
    protected $appends = array('thumbnail');

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions() {
       return $this->hasMany('App\Question');
    }

    public function answers() {
       return $this->hasMany('App\Answer');
    }
    // 遵循規則 get____Atrribute()
    public function getThumbnailAttribute() {

        $path = pathinfo($this->profile_pic);
        // dirname =url 不包刮檔名附檔名 ex:http://fish/web/hi/xxx.jpg <-xxx.jpg not include filename 不包刮副檔名 
        return $path['dirname'].'/'.$path['filename']."-thumb.jpg";
    }

}
