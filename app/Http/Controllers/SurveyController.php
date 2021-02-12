<?php

namespace App\Http\Controllers;

use App\Service\QuestionRepositoryInterface;
use Illuminate\Http\Request;

use App\Service\SurveyRepositoryInterface;

class SurveyController extends Controller
{
    public function __construct(SurveyRepositoryInterface $repository, QuestionRepositoryInterface $questionRepository)
    {
        $this->repository = $repository;
        $this->questionRepository = $questionRepository;
    }

    /**
     * データを受け取りアンケートを新規作成
     *
     * @param Request $request リクエスト
     */
    public function createSurvey(Request $request)
    {
        //$data = $request->all();
        $data = [
            "title" => "title",
            "description" => "description",
            "owner" => "owner",
            "delete_pass" => "pass",
            "from" => "2021-2-12",
            "to"=>"2021-2-19",
            "questions" => [
                0 => [
                    "title" => "title1",
                    "type" => "text",
                    "is_required" => false,
                    "choice" => [
                        0 => "choice"
                        ]
                    ],
                1 => [
                    "title" => "title2",
                    "type" => "check",
                    "is_required" => true,
                    "choice" => [
                        0 => "choice",
                        1 => "choice append",
                        2 => "choice append",
                        ]
                    ]
                ]
            ];
        
        $questions = $data['questions'];
        unset($data['questions']);
        $survey = $data;

        $id = $this->repository->saveSurvey($survey);

        foreach ($questions as $questionNum => $question) {
            $this->questionRepository->saveQuestion($id, $questionNum + 1, $question);
        }

        dd($id, $survey, $questions);
        return 'ok';
    }

    /**
     * indexページを作成するためのオブジェクトを返却
     * 返り値の情報はまだ未定
     * @return obj json
     */
    public function getSurveys()
    {
        $surveys = json_encode($this->repository->getSurveyOverviews());
        return $surveys;
    }

    /**
     * idを受け取りそのidに応じたアンケートの情報を返却
     * 返り値の情報はまだ未定
     * @return obj json
     */
    public function searchFromId(Request $request)
    {
        $uuid = $request->uuid;
        $survey = json_encode($this->repository->getSurveyQuestions($uuid));
        return $survey;
    }
}
