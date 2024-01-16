<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Course;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();
        School::truncate();
        Course::truncate();
        Student::truncate();

        User::factory(3)->create();

        School::factory(5)
            ->has(Course::factory(5)
                ->has(Student::factory(20)))
            ->create();
    }
}
