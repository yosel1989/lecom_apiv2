<?php

use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\VehicleTicketing\TicketType::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'type'=> 'Virtual',
            'code'=> 1,
        ]);
        \App\Models\VehicleTicketing\TicketType::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'type'=> 'Fisico',
            'code'=> 2,
        ]);
        \App\Models\VehicleTicketing\TicketType::create([
            'id'  => \Ramsey\Uuid\Uuid::uuid4(),
            'type'=> 'Yape',
            'code'=> 3,
        ]);

    }
}
