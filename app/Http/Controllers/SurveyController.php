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
        $survey = json_encode($this->repository->getSurveyOverviews());
        return $survey;
    }

    /**
     * idを受け取りそのidに応じたアンケートの情報を返却
     * 返り値の情報はまだ未定
     * @return obj json
     */
    public function searchFromId(Request $request)
    {
        return 'searchFromId';
    }
}
