<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = ['propertyNumber','primaryAddress','secondaryAddress','type','status', 'lotArea','floorArea','bedrooms','bathrooms',  'garage','price','description', 'isActive','isChosen','isSold'];

    protected $with = ['propertyImages','amenities'];

    public function propertyImages()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function amenities()
    {
        return $this->hasMany(Amenity::class);
    }
}
