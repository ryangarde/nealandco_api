<?php

use App\PropertyStatus;
use Illuminate\Database\Seeder;

class PropertyStatusSeeder extends Seeder
{
  public function run()
  {
    $propertyStatuses = [
      ['name' => 'Sale'],
      ['name' => 'Rent']
    ];

    foreach ($propertyStatuses as $status) {
      PropertyStatus::create($status);
    }
  }
}
