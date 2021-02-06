<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

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
            'type'=>$this->faker->randomElement(['text','checkbox','radio']),
            'title'=>$this->faker->sentence,
            'is_required'=>$this->faker->boolean,
            'choices'=>$this->faker->randomElements($choices,3),
        ];
    }
}
