<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = ['super_admin','admin', 'claims', 'customer_care', 'analyst', 'director'];

        foreach($role as $e){
            \DB::table('roles')->insert(
                [
                    'name' => $e,
                    'description' => ''
                ]
            );
        }
    }
}
