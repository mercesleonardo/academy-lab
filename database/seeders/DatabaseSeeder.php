<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            MaterialTypeSeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
            TrackSeeder::class,
            PathSeeder::class,
            ModuleSeeder::class,
            LessonSeeder::class,
            LessonMaterialSeeder::class,
            RelationshipSeeder::class,
        ]);
    }
}
