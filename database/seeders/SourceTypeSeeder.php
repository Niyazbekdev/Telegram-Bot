<?php

namespace Database\Seeders;

use App\Models\SourceType;
use Illuminate\Database\Seeder;

class SourceTypeSeeder extends Seeder
{

    public function run(): void
    {
        SourceType::create([
            'title' => 'Telegram Bot',
        ]);

        SourceType::create([
            'title' => 'Web',
        ]);
    }
}
