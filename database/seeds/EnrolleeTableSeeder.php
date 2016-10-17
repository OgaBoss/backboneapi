<?php

use Illuminate\Database\Seeder;

class EnrolleeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Enrollee::class, 4)->create();
    }
}
