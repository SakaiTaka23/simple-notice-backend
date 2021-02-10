<?php

namespace App\Service;

interface ResultServiceInterface
{
    /**
     * idを受け取りその調査の回答を作成
     *
     * @param string $uuid その問題のid
     */
    public function getSurveyResults($id);
}
