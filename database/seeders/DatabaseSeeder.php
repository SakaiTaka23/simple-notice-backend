<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Result;
use App\Models\Survey;
use Carbon\Carbon;
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
        $this->createSurvey('now');
        $this->createSurvey('past');
        $this->createSurvey('future');

        $questions = Question::all();
        foreach ($questions as $question) {
            $question->question_number = $question->id % 5;
            if ($question->question_number == 0) {
                $question->question_number = 5;
            }
            $question->save();
        }

        $questions->each(function ($q) {
            $q->results()->saveMany(Result::factory(3)
            ->state([
                'survey_id' => $q->survey_id,
                'question_number' => $q->question_number,
            ])
            ->make());
        });
    }

    public function createSurvey($status, $make=10)
    {
        $survey = '';
        if ($status == 'now') {
            $survey = Survey::factory($make)->create();
        } elseif ($status == 'past') {
            $survey = Survey::factory($make)->state([
                'from' => Carbon::now()->subMonth(),
                'to' => Carbon::now()->subMonth()->addDay(),
            ])->create();
        } elseif ($status == 'future') {
            $survey = Survey::factory($make)->state([
                'from' => Carbon::tomorrow(),
                'to' => Carbon::tomorrow()->addDays(7),
            ])->create();
        }
        
        $survey->each(function ($s) {
            $s->questions()->saveMany(Question::factory(5)->make());
        });
    }
}
