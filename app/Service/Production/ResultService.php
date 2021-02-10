<?php

namespace App\Service\Production;

use App\Service\QuestionRepositoryInterface;
use App\Service\ResultRepositoryInterface;
use App\Service\ResultServiceInterface;
use App\Service\SurveyRepositoryInterface;
use Illuminate\Support\Arr;

class ResultService implements ResultServiceInterface
{
    public function __construct(
        QuestionRepositoryInterface $questionRepository,
        ResultRepositoryInterface $resultRepository,
        SurveyRepositoryInterface $surveyRepository
    )
    {
        $this->questionRepository = $questionRepository;
        $this->resultRepository = $resultRepository;
        $this->surveyRepository = $surveyRepository;
    }

    public function getSurveyResults($id)
    {
        $surveyOverview = $this->surveyRepository->getSurveyOverview($id);

        $question = $this->questionRepository->getQuestionOverview($id, 1);
        $answersAndCount = $this->resultRepository->getAnswersAndCount($id, 1);
        $c = Arr::pluck($answersAndCount, 'count');
        $a = Arr::pluck($answersAndCount, 'answer');
        // $result = [$s,[$q,$a,$c]];
        // $d = Arr::pluck($c, 'count');
        dd($a, $c);
    }
}
