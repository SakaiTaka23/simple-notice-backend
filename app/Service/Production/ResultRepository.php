<?php

namespace App\Service\Production;

use App\Models\Result;
use App\Service\ResultRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ResultRepository implements ResultRepositoryInterface
{
    public function storeSurveyResult(string $uuid, array $results):void
    {
        foreach ($results as $key => $result) {
            if (gettype($result) == 'array') {
                foreach ($result as $item) {
                    $data = Result::where(['survey_id'=>$uuid,'question_number'=>$key,'answer'=>$item])->first();
                    if ($data == []) {
                        Result::insert(['survey_id'=>$uuid,'question_number'=>$key,'answer'=>$item]);
                    } else {
                        $data->count += 1;
                        $data->save();
                    }
                }
            } else {
                $data = Result::where(['survey_id'=>$uuid,'question_number'=>$key,'answer'=>$result])->first();
                if ($data == []) {
                    Result::insert(['survey_id'=>$uuid,'question_number'=>$key,'answer'=>$result]);
                } else {
                    $data->count += 1;
                    $data->save();
                }
            }
        }
    }

    public function getAnswersAndCount(string $uuid, int $question_number):Collection
    {
        return DB::table('results')
        ->select('answer', 'count')
        ->where('survey_id', '=', $uuid)
        ->where('question_number', '=', $question_number)
        ->get();
    }
}
