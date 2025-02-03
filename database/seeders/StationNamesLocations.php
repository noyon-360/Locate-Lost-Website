<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class StationNamesLocations extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // INSERT INTO stations (station_name, locations)
        // VALUES 
        // ('Northern Hub', '["Airport", "Kawla", "Khilkhet", "Shewra", "Banani", "Chairman Bari", "Mohakhali"]'),
        // ('Central Gateway', '["Station Road", "Abdullahpur", "House Building", "Rajlakshmi", "Jashimuddin"]'),
        // ('Eastern Junction', '["Hosain Market", "Shofiuddin", "Collage Gate", "Cherag Ali", "Mill Gate"]'),
        // ('Uttara Terminus', '["Sector 4", "Sector 9", "Uttara Model Town", "Diabari", "Azampur"]'),
        // ('Bashundhara Link', '["Bashundhara Residential Area", "Jamuna Future Park", "Baridhara DOHS", "Kuril", "Notun Bazar"]'),
        // ('Old Dhaka Point', '["Sadarghat", "Chawk Bazar", "Lalbagh", "Ahsan Manzil", "Shankhari Bazar"]'),
        // ('Gulshan Circle', '["Gulshan 1", "Gulshan 2", "Banani Lake", "Baridhara", "Tejgaon-Gulshan Link Road"]'),
        // ('Mirpur Exchange', '["Mirpur 1", "Mirpur 10", "Pallabi", "Kazipara", "Agargaon"]');

        $jsonPath = database_path('seeders/stations.json');
        $json = File::get($jsonPath);
        $data = json_decode($json, true);
        $stations = $data[2]['data'];

        foreach ($stations as $station) {
            DB::table('station_names_locations')->insert([
                'station_name' => $station['station_name'],
                'locations' => json_encode($station['locations']),
            ]);
        }
    }
}
