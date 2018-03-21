<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItemsModel extends Model
{
  public $timestamps = false;
  protected $table = "items";
  protected $fillable = ['user_id','name','price','stock']; //things i could change
  protected $guarded = [];
}
