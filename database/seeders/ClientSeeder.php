<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
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
        Client Type:
         *          0 => Reseller
         *          1 => Business
         **/
        \App\Models\Auth\Client::create([
            'id'            => $client_parent,
            'bussiness_name'=> 'LECOM E.I.R.L.',
            'first_name'    => 'Luis Alexei',
            'last_name'     => 'Fuertes Valdez',
            'ruc'           => '20524372020',
            'dni'           => '',
            'email'         => '',
            'address'       => 'Jr. Pallardelli 465, Comas, Lima, Peru',
            'phone'         => '',
            'type'          => 0,
            'deleted'       => 0,
            'id_parent_client'     => null,
        ]);

        \App\Models\Auth\Client::create([
            'id'            => $client_sinchiroca,
            'bussiness_name'=> 'EMPRESA DE TRANSPORTES SINCHI ROCA S.A',
            'first_name'    => 'Ricardo',
            'last_name'     => 'Valle Palma',
            'ruc'           => '20107882694',
            'dni'           => '',
            'email'         => '',
            'address'       => '',
            'phone'         => '',
            'type'          => 1,
            'deleted'       => 0,
            'id_parent_client'     => $client_parent,
        ]);

        \App\Models\Auth\Client::create([
            'id'            => $client_santacruz,
            'bussiness_name'=> 'TRANSPORTES Y SERVICIOS SANTA CRUZ S.A.C',
            'first_name'    => 'Joan',
            'last_name'     => 'torres',
            'ruc'           => '20101285449',
            'dni'           => '',
            'email'         => '',
            'address'       => '',
            'phone'         => '',
            'type'          => 1,
            'deleted'       => 0,
            'id_parent_client'     => $client_parent,
        ]);
    }
}
