<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client_sinchiroca = '7e1d001f-9f48-4804-b18c-25baf46e8feb';
        $client_santacruz = '125cb48d-7c58-45f6-883d-b585b3d6f99c';

        $vehiculo_santacruz = [
            'AAA-742'=>'04',
            'RRR-999'=>'54',
            'TTT-666'=>'01',
        ];

        $vehiculo_sinchiroca = [
            'AFW-704'=>'33',
        ];

        foreach ( $vehiculo_santacruz as $key => $val ){
            \App\Models\General\Vehicle::create([
                'id'                => \Ramsey\Uuid\Uuid::uuid4(),
                'plate'             => $key,
                'unit'              => $val,
                'deleted'           => 0,
                'id_client'         => $client_santacruz,
                'id_category'       => null,
                'id_model'          => null,
                'id_class'          => null,
            ]);
        }

        foreach ( $vehiculo_sinchiroca as $key => $val ){
            \App\Models\General\Vehicle::create([
                'id'                => \Ramsey\Uuid\Uuid::uuid4(),
                'plate'             => $key,
                'unit'              => $val,
                'deleted'           => 0,
                'id_client'         => $client_sinchiroca,
                'id_category'       => null,
                'id_model'          => null,
                'id_class'          => null,
            ]);
        }
    }
}
