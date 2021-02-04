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
        $survey = json_encode($this->repository->getSurveyQuestions('0dc13eea-8b76-33a6-b4d6-40a33b113d76'));
        return $survey;
    }
}
