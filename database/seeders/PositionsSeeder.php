<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;
use Faker\Factory;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $positions = [
            'Отдел закупок', 'Отдел продаж', 'PR-отдел', 'Бухгалтерия',
        ];

        for($i = 0; $i < count($positions); $i++) {
            Position::create([
                'position' => $positions[$i],
                'quantity' => $faker->numberBetween(3,5),
                'salary' => $faker->numberBetween(7,9)*100,
            ]);
        }

    }
}
