<?php

namespace App\Http\Controllers;

use App\Service\ResultRepositoryInterface;
use Illuminate\Http\Request;

use App\Service\SurveyRepositoryInterface;

class SurveyController extends Controller
{
    public function __construct(SurveyRepositoryInterface $SurveyRepository,ResultRepositoryInterface $ResultRepository)
    {
        $this->SurveyRepository = $SurveyRepository;
        $this->ResultRepository = $ResultRepository;
    }

    /**
     * indexページを作成するためのオブジェクトを返却
     * 返り値の情報はまだ未定
     * @return obj json
     */
    public function getSurveys()
    {
        $surveys = json_encode($this->SurveyRepository->getSurveyOverviews());
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
        $survey = json_encode($this->SurveyRepository->getSurveyQuestions($uuid));
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
        
        $this->ResultRepository->storeSurveyResult($id, $results);
        return 'data stored!';
    }

    /**
     * uuidを受け取り現時点での結果を表すjsonを返す
     * @param $uuid アンケートのuuid
     * @return obj json
     */
    public function showResult($uuid)
    {
        // とりあえずモックid
        $uuid = 'bdf9f8f8-b73d-3d55-8965-c878ddb92746';
        $result = $this->ResultRepository->getSurveyResults($uuid);
        return $result;
    }
}
