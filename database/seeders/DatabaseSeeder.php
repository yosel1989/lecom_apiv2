<?php

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
        $this->call(UserSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(TicketTypeSeeder::class);
        $this->call(VehicleCategorySeeder::class);
        $this->call(VehicleSeeder::class);
        $this->call(TicketMachineSeeder::class);
        $this->call(TicketPriceSeeder::class);
        // $this->call(UsersSantaCruzSeeder::class);
        // $this->call(UserVehiclesSantaCruzSeeder::class);
        //$this->call(UsersSinchirocaSeeder::class);
    }
}
