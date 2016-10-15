<?php

use Illuminate\Database\Seeder;

class HmoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Hmo::class, 1)->create();
    }
}
