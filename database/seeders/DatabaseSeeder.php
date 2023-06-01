<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
//            ClientSeeder::class,
//            TicketTypeSeeder::class,
//            VehicleCategorySeeder::class,
//            VehicleSeeder::class,
//            TicketMachineSeeder::class,
//            TicketPriceSeeder::class
        ]);
        // $this->call(UsersSantaCruzSeeder::class);
        // $this->call(UserVehiclesSantaCruzSeeder::class);
        //$this->call(UsersSinchirocaSeeder::class);
    }
}
