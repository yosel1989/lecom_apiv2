<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TicketMachineSeeder extends Seeder
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

        /**
         * Santa Cruz
         * 865472036927015
         * 867856032332894
         * 867856032351818
         **/

        /**
         * Sinchi Roca
         * 867856032351974
         **/

        \App\Models\VehicleTicketing\TicketMachine::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'imei'=> '865472036927015',
            'deleted'=> 0,
            'id_client'=> $client_santacruz,
            'id_vehicle'=> 'a8766293-4eb3-4ead-b752-04ef432f5b2d',
        ]);
        \App\Models\VehicleTicketing\TicketMachine::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'imei'=> '867856032332894',
            'deleted'=> 0,
            'id_client'=> $client_santacruz,
            'id_vehicle'=> 'de631bd2-813d-4b5b-a1f3-880dd4d6ab1b',
        ]);
        \App\Models\VehicleTicketing\TicketMachine::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'imei'=> '867856032351818',
            'deleted'=> 0,
            'id_client'=> $client_santacruz,
            'id_vehicle'=> '9756da05-6e07-4431-b76d-a1920c1d9d69',
        ]);
        \App\Models\VehicleTicketing\TicketMachine::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'imei'=> '867856032351974',
            'deleted'=> 0,
            'id_client'=> $client_sinchiroca,
            'id_vehicle'=> '901fbdf5-55bd-4ea7-9b96-2696b9cba3c6',
        ]);

    }
}
