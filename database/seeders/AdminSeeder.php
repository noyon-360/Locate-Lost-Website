<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    public function run()
    {
       
        Admin::create([
            'name' => 'Admin',
            'email' => 'noyon@gmail.com',
            'image' => '',
            'password' => Hash::make('noyon1234'), 
        ]);
    }
}