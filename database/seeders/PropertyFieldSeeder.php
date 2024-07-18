<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PropertyFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("property_fields")->insert([
            [
              "id"=>"1",
              "property_id"=>"1",
              "field_name"=>"area",
              "field_value"=>"200",
            ],
            [
              "id"=>"2",
              "property_id"=>"1",
              "field_name"=>"yearOfConstruction",
              "field_value"=>"2015",
            ],
            [
              "id"=>"3",
              "property_id"=>"1",
              "field_name"=>"rooms",
              "field_value"=>"4",
            ],
            [
              "id"=>"4",
              "property_id"=>"1",
              "field_name"=>"heatingType",
              "field_value"=>"gas",
            ],
            [
              "id"=>"5",
              "property_id"=>"1",
              "field_name"=>"parking",
              "field_value"=>"1",
            ],
            [
              "id"=>"6",
              "property_id"=>"1",
              "field_name"=>"price",
              "field_value"=>"500000",
            ],
            [
              "id"=>"7",
              "property_id"=>"2",
              "field_name"=>"area",
              "field_value"=>"150",
            ],
            [
              "id"=>"8",
              "property_id"=>"2",
              "field_name"=>"yearOfConstruction",
              "field_value"=>"2010",
            ],
            [
              "id"=>"9",
              "property_id"=>"2",
              "field_name"=>"rooms",
              "field_value"=>"3",
            ],
            [
              "id"=>"10",
              "property_id"=>"2",
              "field_name"=>"heatingType",
              "field_value"=>"central",
            ],
            [
              "id"=>"11",
              "property_id"=>"2",
              "field_name"=>"parking",
              "field_value"=>"1",
            ],
            [
              "id"=>"12",
              "property_id"=>"2",
              "field_name"=>"price",
              "field_value"=>"800000",
            ],
            [
              "id"=>"13",
              "property_id"=>"3",
              "field_name"=>"area",
              "field_value"=>"100",
            ],
            [
              "id"=>"14",
              "property_id"=>"3",
              "field_name"=>"yearOfConstruction",
              "field_value"=>"2005",
            ],
            [
              "id"=>"15",
              "property_id"=>"3",
              "field_name"=>"rooms",
              "field_value"=>"2",
            ],
            [
              "id"=>"16",
              "property_id"=>"3",
              "field_name"=>"heatingType",
              "field_value"=>"fireplace",
            ],
            [
              "id"=>"17",
              "property_id"=>"3",
              "field_name"=>"parking",
              "field_value"=>1,
            ],
            [
              "id"=>"18",
              "property_id"=>"3",
              "field_name"=>"price",
              "field_value"=>"300000",
            ],

        ]);
    }
}
