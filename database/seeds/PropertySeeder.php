<?php

use App\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $properties = [
      [
        'propertyNumber' => '12314',
        'primaryAddress' => 'TAGUIG, METRO MANILA',
        'secondaryAddress' => 'BONIFACIO GLOBAL CITY',
        'type' => 'Condominium',
        'status' => 'Sale',
        'lotArea' => '231',
        'floorArea' => '231',
        'bedrooms' => '2',
        'bathrooms' => '2',
        'garage' => '1',
        'price' => 1184853,
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae accusamus exercitationem, 
        a adipisci deleniti quaerat totam eos laboriosam explicabo reprehenderit sunt itaque magnam officia 
        mollitia consequatur vel et neque esse.',
      ],
      [
        'propertyNumber' => '3243',
        'primaryAddress' => 'LACSON STREET',
        'secondaryAddress' => 'BACOLOD CITY, NEGROS OCC.',
        'type' => 'House & Lot',
        'status' => 'Rent',
        'lotArea' => '345',
        'floorArea' => '654',
        'bedrooms' => '1',
        'bathrooms' => '1',
        'garage' => '1',
        'price' => 12749729,
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae accusamus exercitationem, 
        a adipisci deleniti quaerat totam eos laboriosam explicabo reprehenderit sunt itaque magnam officia 
        mollitia consequatur vel et neque esse.',
      ],
      [
        'propertyNumber' => '54353',
        'primaryAddress' => 'MANVILLE ROYALE SUBDIVISION',
        'secondaryAddress' => 'BACOLOD CITY, NEGROS OCC.',
        'type' => 'House & Lot',
        'status' => 'Sale',
        'lotArea' => '222',
        'floorArea' => '324',
        'bedrooms' => '1',
        'bathrooms' => '1',
        'garage' => '2',
        'price' => 9485937,
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae accusamus exercitationem, 
        a adipisci deleniti quaerat totam eos laboriosam explicabo reprehenderit sunt itaque magnam officia 
        mollitia consequatur vel et neque esse.',
      ],
      [
        'propertyNumber' => '432423',
        'primaryAddress' => 'MANVILLE ROYALE SUBDIVISION',
        'secondaryAddress' => 'BACOLOD CITY, NEGROS OCC.',
        'type' => 'Condominium',
        'status' => 'Sale',
        'lotArea' => '545',
        'floorArea' => '333',
        'bedrooms' => '2',
        'bathrooms' => '2',
        'garage' => '2',
        'price' => 21857394,
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae accusamus exercitationem, 
        a adipisci deleniti quaerat totam eos laboriosam explicabo reprehenderit sunt itaque magnam officia 
        mollitia consequatur vel et neque esse.',
      ]
    ];

    foreach ($properties as $property) {
      Property::create($property);
    }
  }
}
