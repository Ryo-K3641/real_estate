<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypeSeeder extends Seeder
{
    private $property_type;

    public function __construct(PropertyType $property_type)
    {
        $this->property_type = $property_type;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property_types = [
            ['name' => 'Rowhouse'],
            ['name' => 'Townhouse'],
            ['name' => 'Apartment'],
            ['name' => 'Condominium'],
            ['name' => 'Single-attached'],
            ['name' => 'Single-detached']
        ];

        $this->property_type->insert($property_types);
    }
}
