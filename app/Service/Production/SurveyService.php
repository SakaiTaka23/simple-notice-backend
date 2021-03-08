<?php

namespace App\Service\Production;

use App\Service\SurveyRepositoryInterface;
use App\Service\SurveyServiceInterface;
use Illuminate\Support\Facades\Hash;

class SurveyService implements SurveyServiceInterface {

    public function __construct(SurveyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function checkPassword(string $uuid, string $pass): bool
    {
        $deletePass = $this->repository->getSurveyPassword($uuid);
        if(Hash::check($pass,$deletePass)){
            return true;
        }
        return false;
    }
}
