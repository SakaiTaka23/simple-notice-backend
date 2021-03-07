<?php

namespace App\Http\Requests;

use App\Rules\isAvailable;

class StoreResultRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uuid' => ['bail','exists:surveys,id',new isAvailable]
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
