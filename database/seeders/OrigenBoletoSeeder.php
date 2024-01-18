<?php

namespace Database\Seeders;

use App\Models\V2\OrigenBoleto;
use Illuminate\Database\Seeder;

class OrigenBoletoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrigenBoleto::truncate();

        OrigenBoleto::create([
            'nombre' => 'Pos'
        ]);
        OrigenBoleto::create([
            'nombre' => 'Counter'
        ]);
    }
}
