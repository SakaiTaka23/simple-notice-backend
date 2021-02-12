<?php

namespace App\Http\Requests;

class SearchFromIdRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uuid' => 'exists:surveys,id'
        ];
    }

    /**
     * ルートの値を取得
     */
    protected function prepareForValidation()
    {
        $this->merge([
        'uuid' => $this->route('uuid'),
    ]);
    }
}
