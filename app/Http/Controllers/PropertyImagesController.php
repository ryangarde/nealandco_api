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
      for ($i=0; $i < count(request()->image); $i++) { 
        $path = Storage::putFile('public/property_images', request()->file('image')[$i]);
        $data[$i] = $property->propertyImages()->create(['name' => str_replace("public/","",$path)]);
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
