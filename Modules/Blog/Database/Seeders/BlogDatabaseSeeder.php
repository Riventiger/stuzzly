<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blogs')->insert([
            [
                'title' => 'Welcome to the Blog Module',
                'body' => 'This is a sample blog post created by the seeder.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Second Article',
                'body' => 'Here’s another example post for testing purposes.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
