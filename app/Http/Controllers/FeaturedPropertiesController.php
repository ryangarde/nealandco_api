<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class FeaturedPropertiesController extends Controller
{
  public function index()
  {
    return Property::where([['isSold',0],['isChosen',1],['isSold',0]])->get();
  }

  public function indexActive()
  {
    return Property::where([['isActive',1],['isSold',0],['isChosen',1]])->with('propertyImages')->get();
  }

  public function store()
  {
    Property::where('isChosen',1)->update(['isChosen'=>0]);
    foreach (request()->properties as $property) {
      Property::where('id',$property['id'])->update(['isChosen'=>1]);
    }

    return Property::where('isChosen',1)->get();
  }

  public function storeOne(Property $property)
  {
    if(request()->isChosen){
      $property->fill(['isChosen' => 1])->save();
    } else {
      $property->fill(['isChosen' => 0])->save();
    }

    return $property;
  }

  public function show(Property $property)
  {
    return $property;
  }

  public function destroy(Property $property)
  {
    // Property::where('id',$property->id)->update(['isChosen' => 0]);
    $property->fill(['isChosen' => 0])->save();
    return $property;
  }
}
