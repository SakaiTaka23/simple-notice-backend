<?php

namespace App\Service;

interface QuestionRepositoryInterface
{

    /**
     * 問題のid,question_numberからタイトル、タイプを取得
     *
     * @param string $uuid そのアンケートのid
     * @param int $question_number 問題番号
     */
    public function getQuestionOverview(string $uuid, int $question_number);
}
