<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\User::class)->create([
                'name' => 'Oscar Arocha',
                'email' => 'arocha.oscar@gmail.com',
                'password' => bcrypt('Ing.S1st01'),
                'role' => 'root'
        ]);

        factory(App\User::class,5)->create([
            'password' => bcrypt('Clave.123'),
            'role' => 'owner'
        ]);


    }
}
