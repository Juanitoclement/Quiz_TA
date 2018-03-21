<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
  public $timestamps = false;
  protected $table = "user";
  protected $fillable = ['name','email','password']; //things i could change LOL
  protected $guarded = [];

  public function itemconnect()
  {
    return $this->hasMany('App\Model\ItemsModel','user_id','id');
    //Directory , foreignkey, primary key of table User
  }
}
