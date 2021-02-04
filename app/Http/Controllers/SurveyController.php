<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * indexページを作成するためのオブジェクトを返却
     * 返り値の情報はまだ未定
     * @return obj json
     */
    public function getSurveys()
    {
        return 'getSurveys';
    }

    /**
     * idを受け取りそのidに応じたアンケートの情報を返却
     * 返り値の情報はまだ未定
     * @return obj json
     */
    public function searchFromId(Request $request)
    {
        return 'searchFromId';
    }
}
