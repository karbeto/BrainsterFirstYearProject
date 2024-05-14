<?php

namespace Database\Seeders;

use App\Models\Cities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Skopje',
            'Berovo',
            'Bitola',
            'Bogdanci',
            'Debar',
            'Delčevo',
            'Demir Hisar',
            'Dojran',
            'Gevgelija',
            'Gostivar',
            'Kavadarci',
            'Kicevo',
            'Kumanovo',
            'Kocani',
            'Kratovo',
            'Kriva Palanka',
            'Krusevo',
            'Makedonski Brod',
            'Negotino',
            'Ohrid',
            'Pehcevo',
            'Prilep',
            'Probistip',
            'Radovis',
            'Resen',
            'Struga',
            'Strumica',
            'Sveti Nikole',
            'Stip',
            'Tetovo',
            'Valandovo',
            'Veles',
            'Vinica'
        ];

        foreach ($cities as $city) {
            Cities::create([
                'name' => $city,
            ]);
        }
    }
}
