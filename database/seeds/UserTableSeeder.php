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
                'name' => 'Administrador Sistema',
                'email' => 'aplicaciones.sias@gmail.com',
                'password' => bcrypt('Clave.123'),
                'role' => 'root',
                'status' => 'A'
        ]);

        factory(App\User::class)->create([
            'name' => 'Administrador Aplicaiones',
            'email' => 'rosalessaile@gmail.com',
            'password' => bcrypt('Clave.123'),
            'role' => 'owner',
            'status' => 'A'
        ]);


    }
}
