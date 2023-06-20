<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $StoresIds=Store::get()->pluck('id')->toArray();
        $categories=Category::get()->pluck('id')->toArray();
        $price = $this->faker->randomFloat(2,100,10000);
        $discount_ratio = $this->faker->randomFloat(0,1,90);
        return [

            "name_ar"=>$this->faker->name,
            "name_en"=>$this->faker->name,
            "details_ar"=>$this->faker->text,
            "details_en"=>$this->faker->text,
            "status"=>1,
            "is_active"=>1,
            "discount_ratio"=>$discount_ratio,
            'price' => $price,
            'sale_price' => $price - $price * $discount_ratio,
            'show_in_slider' => $this->faker->randomElement([0,1]),
            'is_feature' => $this->faker->randomElement([0,1]),
            "store_id"=>$this->faker->randomElement($StoresIds),
            "category_id"=>$this->faker->randomElement($categories),
            "annotation"=>$this->faker->sentence,
            "created_at"=>now(),
            "updated_at"=>now(),
        ];
    }
}
