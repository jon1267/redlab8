<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\Position;
use Faker\Factory;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$faker = Factory::create('uk_UA');
        $faker = Factory::create('ru_RU');

        foreach (range(1, 10) as $i) {
            Staff::create([
                'first_name' => (($i % 2) == 0) ? $faker->firstNameMale : $faker->firstNameFemale,
                'last_name' => $faker->lastName,
                'middle_name' => (($i % 2) == 0) ? $faker->middleNameMale() : $faker->middleNameFemale(),
                'sex' => (($i % 2) == 0) ? 'мужской' : 'женский',
                'salary' => 600,
            ]);
        }

        foreach (Staff::all() as $people) {
            $positions = Position::inRandomOrder()->take(rand(1,3))->pluck('id');
            $people->positions()->attach($positions);
        }
    }
}
