<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service\SurveyRepositoryInterface;

class SurveyController extends Controller
{
    public function __construct(SurveyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * indexページを作成するためのオブジェクトを返却
     * 返り値の情報はまだ未定
     * @return obj json
     */
    public function getSurveys()
    {
        $surveys = json_encode($this->repository->getSurveyOverviews());
        return $surveys;
    }

    /**
     * idを受け取りそのidに応じたアンケートの情報を返却
     * 返り値の情報はまだ未定
     * @return obj json
     */
    public function searchFromId(Request $request)
    {
        $uuid = $request->uuid;
        $survey = json_encode($this->repository->getSurveyQuestions($uuid));
        return $survey;
    }

    public function storeResult(Request $request)
    {
        $results = [
            'id' => '04bcd32d-c41b-35db-aeac-265408b83c7f',
            1 => 'a',
            2 => ['b','d'],
            3 => 'b',
            4 => 'd',
            5 => 'e',
        ];

        $id = $results['id'];
        unset($results['id']);
        
        $this->repository->storeSurveyResult($id,$results);
        return $request;
    }
}
