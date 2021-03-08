<?php

namespace App\Service\Production;

use App\Models\Survey;
use App\Service\SurveyRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\Builder;

class SurveyRepository implements SurveyRepositoryInterface
{
    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    public function saveSurvey(array $survey_data):string
    {
        $id = uniqid();
        DB::table('surveys')->insert([
            'id' => $id,
            'title' => $survey_data['title'],
            'description' => $survey_data['description'],
            'owner' => $survey_data['owner'],
            'delete_pass' => Hash::make($survey_data['delete_pass']),
            'from' => $survey_data['from'],
            'to' => $survey_data['to'],
        ]);

        return $id;
    }

    public function getSurveyOverviews(string $status):LengthAwarePaginator
    {
        $query = DB::table('surveys')->select(['id','title','description','owner','from','to']);
        $query = $this->surveyStatus($query, $status);
        $query = $query->paginate(10);
        return $query;
    }

    private function surveyStatus(Builder $query, string $status):Builder
    {
        if ($status == 'now') {
            return $query->where('from', '<=', Carbon::today())->where('to', '>=', Carbon::today())->orderBy('to');
        } elseif ($status == 'future') {
            return $query->where('from', '>', Carbon::today())->orderBy('from');
        } elseif ($status == 'past') {
            return $query->where('to', '<', Carbon::today())->orderBy('to');
        }
    }

    public function getSurveyQuestions(string $uuid):object
    {
        return $this->survey->where('id', $uuid)->with('questions')->get();
    }

    public function getSurveyOverview(string $uuid):object
    {
        return DB::table('surveys')
        ->select('title', 'description', 'owner')
        ->where('id', $uuid)
        ->first();
    }
}
