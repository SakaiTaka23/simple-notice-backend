<?php

namespace App\Service\Production;

use App\Models\Survey;
use App\Service\SurveyRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SurveyRepository implements SurveyRepositoryInterface
{
    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    public function getSurveyOverviews()
    {
        return DB::table('surveys')->get();
    }

    public function getSurveyQuestions(string $uuid)
    {
        return $this->survey->where('id', $uuid)->with('questions')->get();
    }
}
