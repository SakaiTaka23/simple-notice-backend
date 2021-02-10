<?php

namespace App\Service\Production;

use App\Service\QuestionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function getQuestionOverview(string $uuid, int $question_number)
    {
        $result = DB::table('questions')
        ->select('title', 'type')
        ->where('survey_id', '=', $uuid)
        ->where('question_number', '=', $question_number)
        ->first();

        return $result;
    }

    public function getQuestionCount(string $uuid)
    {
        $count = DB::table('questions')
        ->where('survey_id', $uuid)
        ->max('question_number');
        
        return $count;
    }
}
