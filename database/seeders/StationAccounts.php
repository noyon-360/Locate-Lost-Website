<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class StationAccounts extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path to the JSON file
        $jsonPath = database_path('seeders/stations_account.json');

        // Read the JSON file
        $json = File::get($jsonPath);

        // Decode the JSON data
        $data = json_decode($json, true);

        // Extract the data array from the JSON structure
        $users = $data[2]['data'];

        // Insert the data into the database
        foreach ($users as $user) {
            DB::table('stations')->insert([
                'id' => $user['id'],
                'station_name' => $user['station_name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role' => "station",
                'station_picture' => $user['station_picture'],
                'last_login_at' => $user['last_login_at'],
                'status' => $user['status'],
                'created_at' => $user['created_at'],
                'updated_at' => $user['updated_at'],
            ]);
        }
    }
}
