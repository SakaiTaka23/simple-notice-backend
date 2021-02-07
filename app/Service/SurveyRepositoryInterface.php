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
}
