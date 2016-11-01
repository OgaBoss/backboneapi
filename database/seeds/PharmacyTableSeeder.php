<?php

use Illuminate\Database\Seeder;

class PharmacyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Pharmacy::class, 20)->create();
    }
}
