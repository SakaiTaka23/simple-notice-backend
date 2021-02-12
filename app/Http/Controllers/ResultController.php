<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowResultRequest;
use App\Http\Requests\StoreResultRequest;
use App\Service\ResultRepositoryInterface;
use App\Service\ResultServiceInterface;

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
    public function storeResult(StoreResultRequest $request)
    {
        dd('store');
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
    public function showResult(ShowResultRequest $request)
    {
        $uuid = $request->uuid;
        $results = json_encode($this->result->getSurveyResults($uuid));
        return $results;
    }
}
