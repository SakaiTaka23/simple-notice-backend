<?php

namespace App\Http\Controllers;

use App\Service\ResultRepositoryInterface;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct(ResultRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
        $uuid = 'bdf9f8f8-b73d-3d55-8965-c878ddb92746';
        $result = $this->repository->getSurveyResults($uuid);
        return $result;
    }
}
