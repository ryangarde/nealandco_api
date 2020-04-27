<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyStatus;
use App\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PropertiesController extends Controller
{
  public function index()
  {
    $data = Property::all();
    $featuredPropertiesCount = count(Property::where([['isChosen',1],['isSold',0]])->get());
    return response()->json(compact('data','featuredPropertiesCount'));
  }

  public function indexActive()
  {
    return Property::where('isActive',1)->paginate(9);
  }

  public function indexNotDone()
  {
    return Property::where([['isActive',1],['isSold',0]])->with('propertyImages')->paginate(9);
  }

  public function indexNotDoneNoPaginate()
  {
    return Property::where([['isActive',1],['isSold',0]])->with('propertyImages')->get();
  }
  
  public function store()
  {
    $data = DB::transaction(function () {
      $property = Property::create(request()->all());

      for ($i=0; $i < count(request()->image); $i++) { 
        $path = Storage::putFile('public/property_images', request()->file('image')[$i]);
        $property->propertyImages()->create(['name' => str_replace("public/","",$path)]);
      }

      return $data = ['property' => $property, 'propertyImages' => $property->propertyImages];
    });
    
    return response()->json($data);
  }

  public function show($id)
  {
    return Property::where('id',$id)->with(['propertyImages','amenities'])->first();
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
    $prices = Property::orderByRaw($query)->where('isSold',0)->pluck('price');

    $minPrice = floor($prices[0] / 1000000);
    $maxPrice = ceil($prices[count($prices) - 1] / 1000000);

    return compact('minPrice','maxPrice');
  }

  public function search(Request $request)
  {
    $properties = Property::with('propertyImages');

    if($request->propertyNumber) 
      $properties = $properties->where('propertyNumber','like','%'.$request->propertyNumber.'%');

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

    if($request->minPrice) 
      $properties = $properties->where('price','>',$request->minPrice*1000000);

    if($request->maxPrice) 
      $properties = $properties->where('price','<',$request->maxPrice*1000000);

    return $properties->paginate(9);
  }

  public function propertySold(Property $property)
  {
    if ($property->isSold == 1)
      $property->fill(['isSold' => 0])->save();
    else
      $property->fill(['isSold' => 1,'isChosen'=> 0])->save();
    return $property;
  }
}
