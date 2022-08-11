<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Table::create([
            'name' => 'Table 1'
        ]);
        Table::create([
            'name' => 'Table 2'
        ]);
        Table::create([
            'name' => 'Table 3'
        ]);
        Table::create([
            'name' => 'Table 4'
        ]);
        Table::create([
            'name' => 'Table 5'
        ]);
        Table::create([
            'name' => 'Table 6'
        ]);
        Table::create([
            'name' => 'Table 7'
        ]);
        Table::create([
            'name' => 'Table 8'
        ]);
        Table::create([
            'name' => 'Table 9'
        ]);
    }
}
