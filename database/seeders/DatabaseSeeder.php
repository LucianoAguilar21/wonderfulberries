<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $user = User::create([
            'name' => 'Luciano',
            'email' => 'luciano@gmail.com',
            'password' => Hash::make('123123'),
        ]);


        // Client::factory(10)->create();

        $this->call([
            RoleAndPermissionsSeeder::class,
            ClientSeeder::class,
            DestinationSeeder::class,
            ExporterSeeder::class,
            FieldSeeder::class,
            VarietySeeder::class,
        ]);
        $user->assignRole('super-admin');


    }
}
