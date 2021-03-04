<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class SurveyOverviewRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => [Rule::in(['now','future','past']),'nullable'],
        ];
    }

    /**
     * ルートの値を取得
     */
    protected function prepareForValidation()
    {
        $this->merge([
        'status' => $this->route('status'),
    ]);
    }
}
