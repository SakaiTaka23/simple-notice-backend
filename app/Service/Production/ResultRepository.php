<?php

namespace App\Service\Production;

use App\Service\ResultRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ResultRepository implements ResultRepositoryInterface
{
    public function storeSurveyResult(string $uuid, array $results):void
    {
        foreach ($results as $key => $result) {
            if (gettype($result) == 'array') {
                foreach ($result as $item) {
                    DB::table('results')->insert(['survey_id'=>$uuid,'question_number'=>$key,'answer'=>$item]);
                }
            } else {
                DB::table('results')->insert(['survey_id'=>$uuid,'question_number'=>$key,'answer'=>$result]);
            }
        }
    }

    public function getSurveyResults(string $uuid)
    {
        $results = DB::table('results')->select(['question_number','answer'])->where('survey_id',$uuid)->get();
        dd($results);
        return 'results';
    }
}
