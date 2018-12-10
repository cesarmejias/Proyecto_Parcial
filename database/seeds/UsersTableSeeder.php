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
        App\User::create([
            'name'      => 'Cesar Mejias',
            'email'     => 'cesarmejiasupta@gmail.com',
            'password'     =>'benita6996',

        ]);

        factory(App\User::class, 7)->create();
    }
}
