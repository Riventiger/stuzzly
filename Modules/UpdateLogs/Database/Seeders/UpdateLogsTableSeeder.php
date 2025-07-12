<?php

namespace Modules\UpdateLogs\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UpdateLogs\Models\UpdateLog;

class UpdateLogsTableSeeder extends Seeder
{
    public function run(): void
    {
        UpdateLog::factory()->count(5)->create();
    }
}
