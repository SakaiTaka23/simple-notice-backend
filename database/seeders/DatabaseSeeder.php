<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Survey;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $survey = Survey::factory()->create();
       $survey->each(function ($s) {
        $s->questions()->saveMany(Question::factory(5)->make());
        });
    }
}
