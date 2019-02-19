<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        User::create([
            'name' => 'admin' ,
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'rol' => 'admin' ,
            'birthdate' => '1996-05-17' ,
        ]);

        User::create([
            'name' => 'orlenmar' ,
            'email' => 'orlenmar@gmail.com',
            'password' => bcrypt('qwerty'),
            'rol' => 'user',
            'birthdate' => '1996-05-17' ,
        ]);

        User::create([
            'name' => 'juvenil' ,
            'email' => 'juvenil@gmail.com',
            'password' => bcrypt('qwerty'),
            'rol' => 'user',
            'birthdate' => '2004-05-17' ,
        ]);

        $array_fechas = [
                    '1991-09-01',
                    '1996-09-20',
                    '2000-11-10',
                    '2005-11-20',
                    '2006-12-01',
                    '2007-12-31',
                    '2008-01-01',
                    '2010-01-02',
                    '2014-01-31',
                ];


        for ($i=0; $i < 80; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('qwerty'),
                'rol' => 'user',
                'birthdate' => $array_fechas[rand(0, 7)],
            ]);
        }

    }
}
