<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'body',
    ];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\Factories\BlogFactory::new();
    }
}
