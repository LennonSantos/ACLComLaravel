<?php

use Illuminate\Database\Seeder;

// use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'id'         => 1,
            'name'       => 'Administrador',
            'email'      => 'adm@adm.com',
            'password'   => Hash::make('123456'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
