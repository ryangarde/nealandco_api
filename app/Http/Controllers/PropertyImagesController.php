<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PropertyImagesController extends Controller
{
  public function index(Property $property)
  {
    return $property->propertyImages;
  }

  public function store(Property $property, Request $request)
  {
    $data = DB::transaction(function () use ($property, $request) {
      if(request()->type === 'standard') {
        for ($i=0; $i < count(request()->images); $i++) {
          $path = count($request->file('images')) > 0 ? $request->file('images')[$i]->store('public/property_images') : null;

          $data[$i] = $property->propertyImages()->create([
            'name' => $path ? (env('APP_URL') . '/storage/' . str_replace('public/', '' ,$path)) : null,
            'type' => request()->type
          ]);
        }
      } else {
          // $path = Storage::putFile('public/property_images', request()->file('image'));
          $path = $request->file('image') ? $request->file('image')->store('public/property_images') : null;

          $data = [$property->propertyImages()->create([
            'name' => $path ? (env('APP_URL') . '/storage/' . str_replace('public/', '' ,$path)) : null,
            'type' => request()->type]
          )];
      }
      return $data;
    });

    return $data;
  }

  public function showImage(PropertyImage $propertyImage)
  {
    return Storage::disk('public')->download($propertyImage->name);
  }

  public function destroy(Property $property, PropertyImage $propertyImage)
  {
    $propertyImage->delete();
  }
}
