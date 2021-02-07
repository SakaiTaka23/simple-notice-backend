<?php

namespace Database\Factories;

use App\Models\Result;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Result::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $choices = ['a','b','c','d','e','f'];
        return [
            'survey_id'=>$this->faker->uuid,
            'question_number'=>$this->faker->randomDigit(),
            'answer'=>$this->faker->randomElement($choices),
            'count'=>$this->faker->randomDigit(),
        ];
    }
}
