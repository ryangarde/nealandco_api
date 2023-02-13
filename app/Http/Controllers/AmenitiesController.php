<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Property;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    public function index(Property $property)
    {
        return $property->amenities;
    }

    public function store(Property $property)
    {
        $property->amenities()->delete();
        $amenities = [];
        foreach (request()->amenities as $index => $amenity) {
            $amenities[$index] = $property->amenities()->create(['description' => $amenity['description']]);
        }

        return $amenities;
    }

    public function destroy(Property $property, Amenity $amenity)
    {
        $amenity->delete();
    }
}
