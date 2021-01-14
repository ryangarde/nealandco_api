<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PropertyImagesController extends Controller
{
  public function index(Property $property)
  {
    return $property->propertyImages;
  }

  public function store(Property $property)
  {
    $data = DB::transaction(function () use ($property) {
      for ($i=0; $i < count(request()->images); $i++) {
        $data[$i] = $property->propertyImages()->create(['name' => request()->images[$i]]);
      }

      return $data;
    });

    return $data;
  }

  public function destroy(Property $property, PropertyImage $propertyImage)
  {
    $propertyImage->delete();
  }
}
