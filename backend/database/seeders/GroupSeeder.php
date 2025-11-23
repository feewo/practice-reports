<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            ['name' => 'ИТ-1', 'course' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ИТ-2', 'course' => 2,'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ПИ-1', 'course' => 1,'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ПИ-2', 'course' => 2,'created_at' => now(), 'updated_at' => now()],
        ];

        Group::insert($groups);
    }
}