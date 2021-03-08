<?php

namespace App\Service;


interface SurveyServiceInterface{
    /**
     * 対象のアンケートに対してパスワードが一致しているか調査
     * あっていたらtrue、間違っていたらfalse
     * 
     * @param string $uuid uuid
     * @param string $pass そのパスワードだと思ったもの
     * 
     * @return bool
     */
    public function checkPassword(string $uuid,string $pass):bool;
}
