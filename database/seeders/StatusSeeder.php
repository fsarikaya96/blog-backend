<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::query()->create([
           'uuid' => Str::uuid(),
           'code' => 'active',
           'name_tr' => 'Aktif',
           'name_en' => 'Active',
        ]);

        Status::query()->create([
            'uuid' => Str::uuid(),
            'code' => 'passive',
            'name_tr' => 'Pasif',
            'name_en' => 'Passive',
        ]);
    }
}
