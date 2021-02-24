<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Result;
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
        $survey = Survey::factory(60)->create();
        $survey->each(function ($s) {
            $s->questions()->saveMany(Question::factory(5)->make());
        });

        $questions = Question::all();
        foreach ($questions as $question) {
            $question->question_number = $question->id % 5;
            if ($question->question_number == 0) {
                $question->question_number = 5;
            }
            $question->save();
        }

        $questions->each(function ($q) {
            $q->results()->saveMany(Result::factory(10)
            ->state([
                'survey_id' => $q->survey_id,
                'question_number' => $q->question_number,
            ])
            ->make());
        });
    }
}
