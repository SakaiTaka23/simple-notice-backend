<?php

namespace App\Service\Production;

use App\Models\Result;
use App\Service\ResultRepositoryInterface;
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

    public function getSurveyResults(string $uuid)
    {
        $results = DB::table('results')
        ->select('results.question_number','questions.title','questions.type','results.answer','results.count')
        ->join('questions',function($join){
            $join->on('questions.survey_id','=','results.survey_id')
            ->on('questions.question_number','=','results.question_number')
            ->where('results.survey_id','=','145e2c82-1814-3b52-99bd-7ea79e2d72f5');
        })
        ->orderBy('results.question_number')
        ->orderBy('results.count')
        ->orderBy('results.answer')
        ->get();

        dd($results);
        return 'results';
    }

    public function getAnswerAndCount(string $uuid, int $question_number)
    {
        $results = DB::table('results')
        ->select('answer','count')
        ->where('survey_id','=',$uuid)
        ->where('question_number','=',$question_number)
        ->get();
        return $results;
    }
}
