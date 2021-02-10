<?php

namespace App\Service\Production;

use App\Service\QuestionRepositoryInterface;
use App\Service\ResultRepositoryInterface;
use App\Service\ResultServiceInterface;
use App\Service\SurveyRepositoryInterface;

class ResultService implements ResultServiceInterface
{
    public function __construct(
        QuestionRepositoryInterface $questionRepository,
        ResultRepositoryInterface $resultRepository,
        SurveyRepositoryInterface $surveyRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->resultRepository = $resultRepository;
        $this->surveyRepository = $surveyRepository;
    }

    public function getSurveyResults($id)
    {
        $s = $this->surveyRepository->getSurveyOverview($id);
        $q = $this->questionRepository->getQuestionOverview($id, 1);
        $a = $this->resultRepository->getAnswers($id, 1);
        $c = $this->resultRepository->getCounts($id, 1);
        $result = [$s,[$q,$a,$c]];
        dd($result);
    }
}
