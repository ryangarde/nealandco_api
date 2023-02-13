<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $propertyTypes = [
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
