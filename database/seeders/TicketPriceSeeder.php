<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TicketPriceSeeder extends Seeder
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

        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 1,
            'price'=> 4.00,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_santacruz,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 2,
            'price'=> 3.50,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_santacruz,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 3,
            'price'=> 3.00,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_santacruz,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 4,
            'price'=> 2.50,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_santacruz,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 5,
            'price'=> 2.00,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_santacruz,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 6,
            'price'=> 1.50,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_santacruz,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 7,
            'price'=> 1.00,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_santacruz,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 8,
            'price'=> 0.50,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_santacruz,
        ]);



        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 1,
            'price'=> 5.00,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_sinchiroca,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 2,
            'price'=> 4.00,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_sinchiroca,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 3,
            'price'=> 3.00,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_sinchiroca,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 4,
            'price'=> 2.50,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_sinchiroca,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 5,
            'price'=> 2.00,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_sinchiroca,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 6,
            'price'=> 1.50,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_sinchiroca,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 7,
            'price'=> 1.00,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_sinchiroca,
        ]);
        \App\Models\VehicleTicketing\TicketPrice::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'code'=> 8,
            'price'=> 0.50,
            'actived'=>1,
            'deleted'=>0,
            'id_client'=> $client_sinchiroca,
        ]);
    }
}
