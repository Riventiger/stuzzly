<?php

namespace Modules\UpdateLogs\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UpdateLogs\Models\UpdateLog;

class UpdateLogsDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        UpdateLog::factory()->create([
            'title' => 'Initial System Boot',
            'description' => 'System installed and core modules initialized.',
            'status' => 'deployed',
            'type' => 'manual',
            'source' => 'installer',
            'author' => 'System',
            'deployed_at' => now(),
            'metadata' => ['version' => '1.0.0'],
        ]);
    }
}
