<?php


namespace App\Swagger\schemas;


/**
 * Class AirlineSearchObject
 * @OA\Schema(
 *     title="OrderProductObject  model",
 *     description="OrderProductObject model",
 * )
 */
class OrderProduct
{
    /**
     * @OA\Property(
     *     default="",
     *     format="number",
     *     description="product id",
     *     title="product_id",
     * )
     *
     * @var number
     */
    private $product_id;

    /**
     * @OA\Property(
     *     default="",
     *     format="number",
     *     description="store id",
     *     title="store_id",
     * )
     *
     * @var number
     */
    private $store_id;

    /**
     * @OA\Property(
     *     default="",
     *     format="number",
     *     description=" date",
     *     title=" coupon_id",
     *     type="number"
     * )
     *
     * @var number
     */
    private $coupon_id;
    /**
     * @OA\Property(
     *     default="1",
     *     format="number",
     *     description="quantity ",
     *     title="quantity ",
     * )
     *
     * @var number
     */
    private $qty;

    /**
     * @OA\Property(
     *     default="",
     *     format="number",
     *     description="size_id",
     *     title="size",
     * )
     *
     * @var number
     */
    private $size_id;

    /**
     * @OA\Property(
     *     default="",
     *     format="number",
     *     description="color_id",
     *     title="Color",
     * )
     *
     * @var number
     */
    private $color_id;

}
