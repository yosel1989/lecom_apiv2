<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParaderoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\V2\Paradero::create([
            'nombre'=> 'Paradero 1',
            'idRuta'    => 'a8af5916-96c8-49db-9793-688206125483',
            'idCliente'     => '499d4327-7eac-496c-9b24-6d063e281ba4',
            'precioBase'     => 15.00,
            'idUsuarioRegistro' => 'd8246df3-8afe-4265-a1ab-2979d7151ce4'
        ]);

        \App\Models\V2\Paradero::create([
            'nombre'=> 'Paradero 2',
            'idRuta'    => 'a8af5916-96c8-49db-9793-688206125483',
            'idCliente'     => '499d4327-7eac-496c-9b24-6d063e281ba4',
            'precioBase'     => 20.00,
            'idUsuarioRegistro' => 'd8246df3-8afe-4265-a1ab-2979d7151ce4'
        ]);

        \App\Models\V2\Paradero::create([
            'nombre'=> 'Paradero 3',
            'idRuta'    => 'a8af5916-96c8-49db-9793-688206125483',
            'idCliente'     => '499d4327-7eac-496c-9b24-6d063e281ba4',
            'precioBase'     => 25.00,
            'idUsuarioRegistro' => 'd8246df3-8afe-4265-a1ab-2979d7151ce4'
        ]);

        \App\Models\V2\Paradero::create([
            'nombre'=> 'Paradero 4',
            'idRuta'    => 'a8af5916-96c8-49db-9793-688206125483',
            'idCliente'     => '499d4327-7eac-496c-9b24-6d063e281ba4',
            'precioBase'     => 30.00,
            'idUsuarioRegistro' => 'd8246df3-8afe-4265-a1ab-2979d7151ce4'
        ]);

        \App\Models\V2\Paradero::create([
            'nombre'=> 'Paradero 5',
            'idRuta'    => 'a8af5916-96c8-49db-9793-688206125483',
            'idCliente'     => '499d4327-7eac-496c-9b24-6d063e281ba4',
            'precioBase'     => 35.00,
            'idUsuarioRegistro' => 'd8246df3-8afe-4265-a1ab-2979d7151ce4'
        ]);


    }
}
