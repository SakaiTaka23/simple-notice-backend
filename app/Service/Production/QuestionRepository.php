<?php

namespace App\Service\Production;

use App\Service\QuestionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function getQuestionOverview(string $uuid, int $question_number)
    {
        $result = DB::table('questions')
        ->select('title','type')
        ->where('survey_id','=',$uuid)
        ->where('question_number','=',$question_number)
        ->get();

        return $result;
    }
}
