<?php

namespace Database\Seeders;

use App\Models\Types;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Types::create([
            'name' => 'Koncert',
        ]);
    }
}
