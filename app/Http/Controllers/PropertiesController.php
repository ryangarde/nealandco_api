<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class PropertiesController extends Controller
{
  public function index()
  {
    return Property::all();
  }

  public function indexActive()
  {
    return Property::where('isActive',1)->get();
  }

  public function indexNotSold()
  {
    return Property::where([['isActive',1],['isSold',0]])->get();
  }

  public function store()
  {
    return Property::create(request()->all());
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
}
