<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function propertiesSold()
  {
    $soldProperties = Property::select('propertyNumber','price')->where([['isActive',1],['isSold',1],['status','Sale']])->get();
    $totalProperties = Property::select('propertyNumber','price')->where('isActive',1)->get();

    return response()->json(['soldProperties' => $soldProperties,'totalProperties' => $totalProperties]);
  }

  public function propertiesLeased()
  {
    $leasedProperties = Property::select('propertyNumber','price')->where([['isActive',1],['isSold',1],['status','Rent']])->get();
    $totalProperties = Property::select('propertyNumber','price')->where('isActive',1)->get();

    return response()->json(['leasedProperties' => $leasedProperties,'totalProperties' => $totalProperties]);
  }
}
