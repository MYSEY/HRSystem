<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=OptionSeeder
     *
     * @return void
     */
    public function run()
    {
        Option::firstOrCreate([
            'name_khmer' => 'Economics and Management',
            'name_english'=>'Economics and Management',
            'type' => 'field_of_study'
        ]);
        Option::firstOrCreate([
            'name_khmer' => 'Business Analytics',
            'name_english'=>'Business Analytics',
            'type' => 'field_of_study'
        ]);
        Option::firstOrCreate([
            'name_khmer' => 'Master Degree',
            'name_english'=>'Master Degree',
            'type' => 'degree'
        ]);
        Option::firstOrCreate([
            'name_khmer' => 'Bachelor degree',
            'name_english'=>'Bachelor degree',
            'type' => 'degree'
        ]);
    }
}
