<?php

namespace App\Service;

use Illuminate\Support\Collection;

interface ResultRepositoryInterface
{
    /**
     * 結果保存用のエンコード後のjsonオブジェクトを受け取りDBに保存
     *
     * @param string $uuid そのアンケートのid
     * @param array $results result arrays
     */
    public function storeSurveyResult(string $uuid, array $results):void;

    /**
     * 問題のid,question_numberからその答え、その回答数取得
     *
     * @param string $uuid そのアンケートのid
     * @param int $question_number 問題番号
     */
    public function getAnswersAndCount(string $uuid, int $question_number):Collection;
}
