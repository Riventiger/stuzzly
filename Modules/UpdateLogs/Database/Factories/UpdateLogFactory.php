<?php

namespace Modules\UpdateLogs\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UpdateLogs\Models\UpdateLog;

class UpdateLogFactory extends Factory
{
    protected $model = UpdateLog::class;

    public function definition(): array
    {
        return [
            'module_name' => $this->faker->word(),
            'type' => $this->faker->randomElement(['install', 'update', 'rollback']),
            'status' => $this->faker->randomElement(['success', 'failed']),
            'details' => $this->faker->paragraph(),
        ];
    }
}
