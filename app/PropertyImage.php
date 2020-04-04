<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
  protected $fillable = ['name','property_id'];

  public function property()
  {
    return $this->belongsTo(User::class);
  }
}