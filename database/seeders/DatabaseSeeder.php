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
        Survey::factory(10)->has(Question::factory()->count(5)
        ->state(function(array $attributes,Survey $survey){
            return ['survey_id'=>$survey->id];
        }),'questions')->create();
    }
}
