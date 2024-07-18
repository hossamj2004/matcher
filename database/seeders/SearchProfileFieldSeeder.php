<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SearchProfileFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("search_profile_fields")->insert([
            [
                "id" => "1",
                "search_profile_id" => "1",
                "field_name" => "price",
                'min_range_value' => null,
                'max_range_value' => null,
                "exact_value" => "400000",
                "field_type" => "direct",
            ],
            [
                "id" => "2",
                "search_profile_id" => "1",
                "field_name" => "area",
                'min_range_value' => 150,
                'max_range_value' => null,
                "exact_value" => null,
                "field_type" => "range",
            ],
            [
                "id" => "3",
                "search_profile_id" => "1",
                "field_name" => "rooms",
                'min_range_value' => null,
                'max_range_value' => null,
                "exact_value" => 4,
                "field_type" => "direct",
            ],
            [
                "id" => "4",
                "search_profile_id" => "2",
                "field_name" => "price",
                'min_range_value' => null,
                'max_range_value' => null,
                "exact_value" => 800000,
                "field_type" => "direct",
            ],
            [
                "id" => "5",
                "search_profile_id" => "2",
                "field_name" => "area",
                'min_range_value' => 120.00,
                'max_range_value' => null,
                "exact_value" => null,
                "field_type" => "range",
            ],
            [
                "id" => "6",
                "search_profile_id" => "2",
                "field_name" => "yearOfConstruction",
                'min_range_value' => 2000,
                'max_range_value' => null,
                "exact_value" => null,
                "field_type" => "range",
            ],
            [
                "id" => "7",
                "search_profile_id" => "3",
                "field_name" => "price",
                'min_range_value' => null,
                'max_range_value' => null,
                "exact_value" => 350000,
                "field_type" => "direct",
            ],
            [
                "id" => "8",
                "search_profile_id" => "3",
                "field_name" => "area",
                'min_range_value' => null,
                'max_range_value' => 80,
                "exact_value" => null,
                "field_type" => "range",
            ],
            [
                "id" => "9",
                "search_profile_id" => "3",
                "field_name" => "heatingType",
                'min_range_value' => null,
                'max_range_value' => null,
                "exact_value" => "fireplace",
                "field_type" => "direct",
            ],

        ]);
    }
}
