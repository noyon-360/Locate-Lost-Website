<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class MissingPeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path to the JSON file
        $jsonPath = database_path('seeders/missing_people.json');

        // Read the JSON file
        $json = File::get($jsonPath);

        // Decode the JSON data
        $data = json_decode($json, true);

        // Extract the data array from the JSON structure
        $missingPeople = $data[2]['data'];

        // Insert the data into the database
        foreach ($missingPeople as $person) {
            DB::table('missing_people')->insert([
                'fullname' => $person['fullname'],
                'date_of_birth' => $person['date_of_birth'],
                'gender' => $person['gender'],
                'permanent_address' => $person['permanent_address'],
                'last_seen_location_description' => $person['last_seen_location_description'],
                'father_name' => $person['father_name'],
                'mother_name' => $person['mother_name'],
                'contact_number' => $person['contact_number'],
                'email' => $person['email'],
                'front_image' => $person['front_image'],
                'additional_pictures' => $person['additional_pictures'],
                'user_email' => $person['user_email'],
                'user_id' => $person['user_id'],
                'missing_date' => $person['missing_date'],
                'created_at' => $person['created_at'],
                'updated_at' => $person['updated_at'],
                'status' => $person['status'],
            ]);
        }
    }
}

