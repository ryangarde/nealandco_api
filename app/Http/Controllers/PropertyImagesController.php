<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyImagesController extends Controller
{
  public function index(Property $property)
  {
    return $property->propertyImages;
  }

  public function store(Property $property)
  {
    $path = Storage::putFile('public/property_images', request()->file('image'));
    return $property->propertyImages()->create(['name' => str_replace("public/","",$path)]);
  }

  public function destroy(Property $property, PropertyImage $propertyImage)
  {
    $propertyImage->delete();
  }
}
