<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Contact;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=> 'admin',
            'email'=> 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        Contact::create([
            'user_id'=> '1',
            'address'=> 'Shankhamul',
            'number' => '9814275297',
            'city' => 'KTM',
            'zip_code' => '254878',
        ]);
    }
}
