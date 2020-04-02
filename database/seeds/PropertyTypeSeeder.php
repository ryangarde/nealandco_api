<?php

use App\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
  public function run()
  {
    $propertyTypes = [
      ['name' => 'Any'],
      ['name' => 'Single Detached'],
      ['name' => 'Townhouse'],
      ['name' => 'Condominium'],
      ['name' => 'House & Lot'],
      ['name' => 'Warehouse/Industrial'],
      ['name' => 'Commercial Property'],
      ['name' => 'Vacant Lot'],
      ['name' => 'Raw Land']
    ];

    foreach ($propertyTypes as $type) {
      PropertyType::create($type);
    }
  }
}
