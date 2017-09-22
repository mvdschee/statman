<?php

use Illuminate\Database\Seeder;

class RoleIndexTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('role_index')->insert(['role_index_name' => 'owner',]);
        DB::table('role_index')->insert(['role_index_name' => 'writer',]);
        DB::table('role_index')->insert(['role_index_name' => 'reader',]);
    }
}
