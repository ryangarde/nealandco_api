<?php

namespace Database\Seeders;

use App\Models\PropertyStatus;
use Illuminate\Database\Seeder;

class PropertyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
