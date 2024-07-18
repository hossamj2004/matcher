<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("properties")->insert([
            [
              "id"=>"1",
              "name"=>"Awesome House",
              "address"=>"Main Street 123, Cityville",
              "property_type"=>"house",
            ],
            [
              "id"=>"2",
              "name"=>"Luxury Apartment",
              "address"=>"High Street 456, Urbantown",
              "property_type"=>"apartment",
            ],
            [
              "id"=>"3",
              "name"=>"Cozy Cottage",
              "address"=>"Park Avenue 789, Villageton",
              "property_type"=>"cottage",
            ],
            
        ]);
    }
}
