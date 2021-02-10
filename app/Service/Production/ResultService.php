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
        $questions = [];

        for ($i=1;$i<=$question_count;$i++) {
            $newQuestion = [];
            $question = $this->questionRepository->getQuestionOverview($id, $i);
            $answersAndCount = $this->resultRepository->getAnswersAndCount($id, $i);
            $answers = Arr::pluck($answersAndCount, 'answer');
            $counts = Arr::pluck($answersAndCount, 'count');
            $newQuestion = [
                'title'=>$question->title,
                'type'=>$question->type,
                'label'=>$answers,
                'data'=>$counts
            ];
            array_push($questions, $newQuestion);
        }

        $results = [
            'title'=>$surveyOverview->title,
            'description'=>$surveyOverview->description,
            'owner'=>$surveyOverview->owner,
            'questions'=>$questions,
            ];
        return $results;
    }
}
