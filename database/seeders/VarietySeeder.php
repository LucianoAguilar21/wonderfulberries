<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Variety;
class VarietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $varieties_1 = new Variety();
        $varieties_2 = new Variety();

        $varieties_1->name = 'Strawberry';
        $varieties_2->name = 'Blueberry';

        $varieties_1->save();
        $varieties_2->save();
     
    }
}
