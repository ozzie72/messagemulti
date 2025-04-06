<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            'name' => 'Cliente Predeterminado',
            'ip' => '127.0.0.1',
            'port' => '8080',
            'image' => 'default.jpg',
            'divition_id' => 1,
            'department_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}