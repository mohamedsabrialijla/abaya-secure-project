<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('ar_JO');
        return [
            'name_ar'=>$faker->name,
            'name_en'=>$this->faker->name,
            'logo'=>'avatar.png',
            'status'=>1,
            "created_at"=>now(),
            "updated_at"=>now(),
        ];
    }
}
