<?php

namespace App\Service\Production;

use App\Service\QuestionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function getQuestionOverview(string $uuid, int $question_number):object
    {
        return DB::table('questions')
        ->select('title', 'type')
        ->where('survey_id', '=', $uuid)
        ->where('question_number', '=', $question_number)
        ->first();
    }

    public function getQuestionCount(string $uuid):int
    {
        return DB::table('questions')
        ->where('survey_id', $uuid)
        ->max('question_number');
    }

    public function saveQuestion(string $uuid, int $key, array $question):void
    {
        $choices = null;
        if (($question['type'] == 'radio' || $question['type'] == 'check')) {
            $choices = json_encode($question['choice']);
        }

        DB::table('questions')
        ->insert([
            'survey_id' => $uuid,
            'question_number' => $key,
            'type' => $question['type'],
            'title' => $question['title'],
            'is_required' => $question['is_required'],
            'choices' => $choices,
        ]);
    }
}
