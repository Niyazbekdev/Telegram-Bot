<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{

    public function run(): void
    {
        Status::create([
            'title' => 'started',
        ]);

        Status::create([
            'title' => 'registred',
        ]);

        Status::create([
            'title' => 'ordered',
        ]);

        Status::create([
            'title' => 'called',
        ]);
    }
}
