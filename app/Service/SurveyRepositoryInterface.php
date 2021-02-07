<?php

namespace App\Service;

interface SurveyRepositoryInterface
{

    /**
     * 今あるアンケートの一覧を取得
     */
    public function getSurveyOverviews();


    /**
     * uuidを受け取りそのアンケートの情報、質問内容を返す
     *
     * @param $uuid そのアンケートのid
     */
    public function getSurveyQuestions(string $uuid);

    /**
     * 結果保存用のエンコード後のjsonオブジェクトを受け取りDBに保存
     *
     * @param string $uuid そのアンケートのid
     * @param array $results result arrays
     */
    public function storeSurveyResult(string $uuid, array $results):void;

    /**
     * uuidを受け取りその結果一覧を取得
     * 
     * @param string $uuid そのアンケートのid
     */
    public function getSurveyResults(string $uuid);
}
