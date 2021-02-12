<?php

namespace App\Http\Requests;

class SearchFromIdRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
