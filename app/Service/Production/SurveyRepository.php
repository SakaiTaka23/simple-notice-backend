<?php

namespace App\Service\Production;

use App\Service\SurveyRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SurveyRepository implements SurveyRepositoryInterface
{
    public function getSurveyOverviews()
    {
        $surveys = DB::table('surveys')
        ->get();
        return $surveys;
    }

    public function getSurveyQuestions(string $uuid)
    {
    }
}
