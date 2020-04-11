<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function propertiesSold()
  {
    $soldProperties = Property::select('propertyNumber','price')->where([['isActive',1],['isSold',1],['status','Sale']])->get();
    $totalSaleProperties = Property::select('propertyNumber','price')->where([['isActive',1],['status','Sale']])->get();

    return response()->json(['soldProperties' => $soldProperties,'totalSaleProperties' => $totalSaleProperties]);
  }

  public function propertiesLeased()
  {
    $leasedProperties = Property::select('propertyNumber','price')->where([['isActive',1],['isSold',1],['status','Rent']])->get();
    $totalRentProperties = Property::select('propertyNumber','price')->where([['isActive',1],['status','Rent']])->get();

    return response()->json(['leasedProperties' => $leasedProperties,'totalRentProperties' => $totalRentProperties]);
  }
}
