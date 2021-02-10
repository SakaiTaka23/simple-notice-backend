<?php

namespace App\Http\Controllers;

use App\Service\ResultRepositoryInterface;
use App\Service\ResultServiceInterface;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct(ResultRepositoryInterface $repository, ResultServiceInterface $result)
    {
        $this->repository = $repository;
        $this->result = $result;
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

    /**
     * uuidを受け取り現時点での結果を表すjsonを返す
     * @param $uuid アンケートのuuid
     * @return obj json
     */
    public function showResult($uuid)
    {
        // とりあえずモックid
        $results = json_encode($this->result->getSurveyResults($uuid));
        return $results;
    }
}
