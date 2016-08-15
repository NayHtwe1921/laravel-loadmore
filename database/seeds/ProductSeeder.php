<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Product::truncate();

        $faker = \Faker\Factory::create('zh_TW'); // 假資料
        foreach (range(1, 100) as $number) {
            $rand = rand(0, 100);
            \App\Product::create([
                'name' => $faker->name.', random number: '.$rand,
                'details' => $faker->realText,
                'created_at' => \Carbon\Carbon::now()->addDays($number),
            ]);
        }
    }
}
