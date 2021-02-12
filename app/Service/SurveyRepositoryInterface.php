<?php

namespace App\Service;

use Illuminate\Support\Collection;

interface SurveyRepositoryInterface
{

    /**
     * データを受け取りアンケートを作成
     *
     * @param array $survey_data アンケートに関する情報が入った配列
     */
    public function saveSurvey(array $survey_data):string;

    /**
     * 今あるアンケートの一覧を取得
     */
    public function getSurveyOverviews():Collection;

    /**
     * uuidを受け取りそのアンケートの情報、質問内容を返す
     *
     * @param $uuid そのアンケートのid
     */
    public function getSurveyQuestions(string $uuid);

    /**
     * idからそのアンケートのタイトル、詳細、オーナーを取得
     *
     * @param string $uuid そのアンケートのid
     */
    public function getSurveyOverview(string $uuid);
}
