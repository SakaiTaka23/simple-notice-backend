<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CreateSurveyRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required','string'],
            'description' => ['required','string'],
            'owner' => ['required','string'],
            'delete_pass'=> ['required','string'],
            'from'=> ['required','date','date_format:Y-m-d'],
            'to'=> ['required','date','after:tomorrow','date_format:Y-m-d'],
            'questions' => ['required','array'],

            'questions.*.title' => ['required','string'],
            'questions.*.type' => ['required',Rule::in(['text','checkbox','radio'])],
            'questions.*.is_required' => ['required','boolean'],
            'questions.*.choice' => ['array'],
            'questions.*.choice.*' => ['string'],
        ];
    }
}
