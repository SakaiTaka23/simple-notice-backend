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
    ) {
        $this->questionRepository = $questionRepository;
        $this->resultRepository = $resultRepository;
        $this->surveyRepository = $surveyRepository;
    }

    public function getSurveyResults($id)
    {
        $surveyOverview = $this->surveyRepository->getSurveyOverview($id);

        $question_count = $this->questionRepository->getQuestionCount($id);

        $question = $this->questionRepository->getQuestionOverview($id, 1);
        $answersAndCount = $this->resultRepository->getAnswersAndCount($id, 1);
        $answers = Arr::pluck($answersAndCount, 'answer');
        $counts = Arr::pluck($answersAndCount, 'count');
        $results = [
            'title'=>$surveyOverview->title,
            'description'=>$surveyOverview->description,
            'owner'=>$surveyOverview->owner,
            'questions'=>
                [
                    [
                    'title'=>$question->title,
                    'type'=>$question->type,
                    'label'=>$answers,
                    'data'=>$counts
                    ],
                    [
                    'title'=>$question->title,
                    'type'=>$question->type,
                    'label'=>$answers,
                    'data'=>$counts
                    ]
                ]
            ];
        // dd($results);
        return $results;
    }
}
