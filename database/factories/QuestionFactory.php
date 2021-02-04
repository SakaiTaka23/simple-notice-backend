<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            // 'survey_id'=>$this->faker->uuid,
            'question_number'=>$this->faker->randomDigit(),
            'type'=>$this->faker->randomElement(['text','checkbox','radio']),
            'name'=>$this->faker->name,
            'title'=>$this->faker->sentence,
            'is_required'=>$this->faker->boolean,
            'choices'=>json_encode($this->faker->randomElements([
            "house",
            "flat", 
            "apartment", 
            "room", "shop", 
            "lot", "garage"],3)),
        ];
    }
}
