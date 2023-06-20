<?php

namespace Database\Factories;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images=[
            '176-093940-fashion-gulf-abayas-2021-2.png',
            '456a303717cc28ddac97a96485bff71a.jpg',
            '4942521-1306140443.jpg',
            '4_141.jpg',
            '7875451-48676708.jpg',
            'images.jpg',
            'unnamed.jpg',
            'images (1).jpg',
            '5272936-712977824.jpg',
            'images (2).jpg',
            '3166dd28e08ff03437c4ea9d33c8be1c.jpg',
            'images (3).jpg',
            'images (4).jpg',
            'images (5).jpg',
            'images (6).jpg',
            'images (7).jpg',
            'images (8).jpg',
            'images (9).jpg',
            'download.jpg',
            'عبايات-بنات-مراهقات-12.jpg',
            '6652.jpg',
            '60fcc189f1ede48d0ef22a31dc66d5b1e59677fb-120221002234.jpg',
            '134828926da4894e0ba58a1489f5962ca279640f-120221002234.jpg',
            'images (10).jpg',
            'eb07e1bdb62b805f95f455114541400b57642d56-120221002234.jpg',
            'images (11).jpg',
            'images (12).jpg',
        ];

        return [
            'image'=>$this->faker->randomElement($images),
            'is_main'=>$this->faker->randomNumber([0,2]),
        ];
    }
}
