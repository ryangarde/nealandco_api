<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
  protected $fillable = ['propertyNumber','primaryAddress','secondaryAddress','type','status',
  'lotArea','floorArea','bedrooms','bathrooms','garage','price','description',
  'isActive','isChosen','isSold'];

  public function propertyImages()
  {
    return $this->hasMany(PropertyImage::class);
  }
}
