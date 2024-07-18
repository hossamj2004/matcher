<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SearchProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("search_profiles")->insert([
            [
              "id"=>"1",
              "name"=>"Family Home Search",
              "property_type"=>"house",
            ],
            [
              "id"=>"2",
              "name"=>"City Apartment Seekers",
              "property_type"=>"apartment",
            ],
            [
              "id"=>"3",
              "name"=>"Retreat in Nature",
              "property_type"=>"cottage",
            ],
            
        ]);
    }
}
