<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Category::create([
            'name' => 'Niños',
            'description' => 'Sumérgete en el maravilloso mundo de la Biblia donde aprenderás y conocerás de los diferentes personajes Bíblicos, esta categoría esta comprendida entre las edades de cuatro (4) a diez (10) años',
            'image' => 'default.png',
            'config' => '4,5,6,7,8,9,10'
        ]);

        Category::create([
            'name' => 'Pre Juveniles',
            'description' => 'esta categoría esta comprendida entre las edades de once (11) a quince (15) años',
            'image' => 'default.png',
            'config' => '11,12,13,14,15'
        ]);

        Category::create([
            'name' => 'Juveniles',
            'description' => 'esta categoría esta comprendía entre las edades de dieciséis (16) a veinte (20) años',
            'image' => 'default.png',
            'config' => '16,17,18,19,20'
        ]);

    }
}
