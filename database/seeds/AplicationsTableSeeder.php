<?php

use Illuminate\Database\Seeder;

class AplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Aplication::class,10)->create();
    }
}
