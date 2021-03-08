<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSurveyRequest;
use App\Http\Requests\DeleteSurveyRequest;
use App\Http\Requests\SearchFromIdRequest;
use App\Http\Requests\SurveyOverviewRequest;
use App\Service\QuestionRepositoryInterface;
use App\Service\SurveyRepositoryInterface;
use App\Service\SurveyServiceInterface;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function __construct(SurveyServiceInterface $survey,SurveyRepositoryInterface $repository, QuestionRepositoryInterface $questionRepository)
    {
        $this->survey = $survey;
        $this->repository = $repository;
        $this->questionRepository = $questionRepository;
    }

    /**
     * データを受け取りアンケートを新規作成
     *
     * @param Request $request リクエスト
     * @return string $id 作成したアンケートのid
     */
    public function createSurvey(CreateSurveyRequest $request)
    {
        $data = $request->all();
        
        $questions = $data['questions'];
        unset($data['questions']);
        $survey = $data;

        $id = $this->repository->saveSurvey($survey);

        foreach ($questions as $questionNum => $question) {
            $this->questionRepository->saveQuestion($id, $questionNum + 1, $question);
        }

        return $id;
    }

    /**
     * アンケートの削除を行う
     * アンケートが開始されていない場合のみ有効
     * @return ?
     */
    public function deleteSurvey(DeleteSurveyRequest $request){
        $uuid = $request->uuid;
        $password = $request->password;

        $passMatches = $this->survey->checkPassword($uuid,$password);
        abort_if(!$passMatches,403);

        $this->repository->deleteSurvey($uuid);
        return;
    }

    /**
     * indexページを作成するためのオブジェクトを返却
     * 返り値の情報はまだ未定
     * @return obj json
     */
    public function getSurveys(SurveyOverviewRequest $request)
    {
        $status = $request->status;
        if (is_null($status)) {
            $status = 'now';
        }
        $surveys = json_encode($this->repository->getSurveyOverviews($status));
        return $surveys;
    }

    /**
     * idを受け取りそのidに応じたアンケートの情報を返却
     * 返り値の情報はまだ未定
     * @return obj json
     */
    public function searchFromId(SearchFromIdRequest $request)
    {
        $uuid = $request->uuid;
        $survey = json_encode($this->repository->getSurveyQuestions($uuid));
        return $survey;
    }
}
