<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'name'=> encrypt('Henk de Vries'),
            'email'    => hash('sha256', 'test@test.nl'),
            'password' => bcrypt('1234567890'),
        ));
    }
}
