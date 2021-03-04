<?php

namespace Database\Factories;

use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class SurveyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Survey::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'=>$this->faker->uuid,
            'owner'=>$this->faker->name,
            'title'=>$this->faker->sentence,
            'description'=>$this->faker->sentence,
            'delete_pass'=>Hash::make('password'),
            'from' =>Carbon::yesterday(),
            'to'=>Carbon::tomorrow(),
        ];
    }
}
