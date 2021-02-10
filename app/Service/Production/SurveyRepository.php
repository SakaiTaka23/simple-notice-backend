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
        return DB::table('surveys')->select(['id','title','description','owner','from','to'])->get();
    }

    public function getSurveyQuestions(string $uuid)
    {
        return $this->survey->where('id', $uuid)->with('questions')->get();
    }

    public function getSurveyOverview(string $uuid)
    {
        $result = DB::table('survey')
        ->select('title', 'description', 'owner')
        ->where('id', $uuid)
        ->get();
        return $result;
    }
}
