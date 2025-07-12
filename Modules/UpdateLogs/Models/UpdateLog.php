<?php

namespace Modules\UpdateLogs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UpdateLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'type',
        'source',
        'author',
        'deployed_at',
        'rollback_token',
        'metadata',
    ];

    protected $casts = [
        'deployed_at' => 'datetime',
        'metadata' => 'array',
    ];
}
