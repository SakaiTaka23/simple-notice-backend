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

    /**
     * リクエストを受け取りそのidをもとに結果をDBへ保存
     * @return obj json
     */
    public function storeResult(Request $request)
    {
        $results = $request->all();
        $id = $request->uuid;
        
        $this->repository->storeSurveyResult($id, $results);
        return 'data stored!';
    }
}
