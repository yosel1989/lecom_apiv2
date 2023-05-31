<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client_parent = 'e21e1f11-19a8-4fb9-99a3-7acd8d3ce5b3';
        $client_sinchiroca = '7e1d001f-9f48-4804-b18c-25baf46e8feb';
        $client_santacruz = '125cb48d-7c58-45f6-883d-b585b3d6f99c';

        /**
            Level User:
         *          0 => Superusuario
         *          1 => Usuario Reseller
         *          2 => Usuario Cliente
         **/

        \App\User::create([
            'id'            => \Ramsey\Uuid\Uuid::uuid4(),
            'username'      => 'admlecomperu',
            'password'      => \Illuminate\Support\Facades\Hash::make('123456789'),
            'first_name'    => 'Luis Alexei',
            'last_name'     => 'Fuertes Valdez',
            'email'         => '',
            'phone'         => '',
            'level'         => 0,
            'actived'       => 1,
            'deleted'       => 0,
            'id_client'     => null,
            'id_role'       => null,
        ]);

        \App\User::create([
            'id'            => \Ramsey\Uuid\Uuid::uuid4(),
            'username'      => 'Sinchiroca@lecom',
            'password'      => \Illuminate\Support\Facades\Hash::make('sinchirocalecom'),
            'first_name'    => 'Ricardo',
            'last_name'     => 'Valle Palma',
            'email'         => 'sinchiroca@lecomperu.com',
            'phone'         => '',
            'level'         => 2,
            'actived'       => 1,
            'deleted'       => 0,
            'id_client'     => $client_sinchiroca,
            'id_role'       => null,
        ]);

        \App\User::create([
            'id'            => \Ramsey\Uuid\Uuid::uuid4(),
            'username'      => 'Santacruz@lecom',
            'password'      => \Illuminate\Support\Facades\Hash::make('santacruzlecom'),
            'first_name'    => 'Joan',
            'last_name'     => 'torres',
            'email'         => 'santacruz@lecomperu.com',
            'phone'         => '',
            'level'         => 2,
            'actived'       => 1,
            'deleted'       => 0,
            'id_client'     => $client_santacruz,
            'id_role'       => null,
        ]);

    }
}
