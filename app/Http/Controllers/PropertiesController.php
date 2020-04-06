<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyStatus;
use App\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertiesController extends Controller
{
  public function index()
  {
    return Property::all();
  }

  public function indexActive()
  {
    return Property::where('isActive',1)->paginate(9);
  }

  public function indexNotSold()
  {
    return Property::where([['isActive',1],['isSold',0]])->with('propertyImages')->paginate(9);
  }

  public function indexNotSoldNoPaginate()
  {
    return Property::where([['isActive',1],['isSold',0]])->with('propertyImages')->get();
  }

  public function store()
  {
    $property = Property::create(request()->all());

    for ($i=0; $i < count(request()->image); $i++) { 
      $path = Storage::putFile('public/property_images', request()->file('image')[$i]);
      $property->propertyImages()->create(['name' => str_replace("public/","",$path)]);
    }

    return response()->json(['property' => $property,'propertyImages' => $property->propertyImages]);
  }

  public function show(Property $property)
  {
    return $property;
  }

  public function update(Property $property)
  {
    $property->fill(request()->all())->save();
    return $property;
  }

  public function destroy(Property $property)
  {
    $property->delete();
  }

  public function getTypes()
  {
    return PropertyType::pluck('name');
  }

  public function getStatuses()
  {
    return PropertyStatus::pluck('name');
  }

  public function getPrices()
  {
    $query = "CAST(price AS DECIMAL(10,2))";
    $prices = Property::orderByRaw($query)->get();

    for($i = 0; $i < count($prices); $i++) {
      if($i == 0) {
        $minPrice = floor($prices[$i]['price'] / 1000000);
      } else if($i == count($prices) - 1) {
        $maxPrice = ceil($prices[$i]['price'] / 1000000);
      }
    }

    return ['minPrice' => $minPrice, 'maxPrice' => $maxPrice];
  }

  public function search(Request $request)
  {
    $properties = Property::with('propertyImages');

    if($request->location) {
      $properties = $properties->where('primaryAddress','like','%'.$request->location.'%')
      ->orWhere('secondaryAddress','like','%'.$request->location.'%');
    }

    if($request->status) 
      $properties = $properties->where('status', $request->status);

    if($request->type) 
      $properties = $properties->whereIn('type', $request->type);

    if($request->lotArea) 
      $properties = $properties->whereBetween('lotArea', [$request->lotArea - 100, $request->lotArea + 100]);

    if($request->bedrooms) 
      $properties = $properties->where('bedrooms', $request->bedrooms);

    if($request->price) 
      $properties = $properties->whereBetween('price', [$request->minPrice, $request->maxPrice]);

    return $properties->paginate(9);
  }

  public function propertySold(Property $property)
  {
    if ($property->isSold == 1)
      $property->fill(['isSold' => 0])->save();
    else
      $property->fill(['isSold' => 1])->save();
    return $property;
  }
}
