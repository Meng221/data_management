<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Database'],
            ['name' => 'Network'],
            ['name' => 'IOT'],
            ['name' => 'Animation']
        ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
