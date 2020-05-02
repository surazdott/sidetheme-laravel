<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
        	'name' => 'Suraj Datheputhe',
            'email' => 'surajdatheputhe@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
            'status' => 1,
            'email_verified_at' => '2020-03-31 12:14:22'
        ]);
    }
}
