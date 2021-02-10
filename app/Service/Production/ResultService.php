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
        $q = $this->questionRepository->getQuestionOverview($id, 1);
        $r = $this->resultRepository->getAnswerAndCount($id, 1);
        $s = $this->surveyRepository->getSurveyOverview($id);
        dd($q, $r, $s);
    }
}
