<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'standard',
                'price' => 100,
            ],
            [
                'name' => 'pro',
                'price' => 1000,
            ],
            [
                'name' => 'enterprise',
                'price' => 10000000,
            ],
        ];

        foreach ($plans as $p) {
            (new \App\Models\Plan($p))->save();
        }
    }
}
