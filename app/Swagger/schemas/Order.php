<?php


namespace App\Swagger\schemas;


/**
 * Class AirlineSearchObject
 * @OA\Schema(
 *     title="OrderData  model",
 *     description="OrderData model",
 * )
 */
class Order
{

    /**
     * @OA\Property(
     *     default="",
     *     format="string",
     *     description="promo_code",
     *     title="promo_code",
     * )
     *
     * @var number
     */
    private $promo_code;
    /**
     * @OA\Property(
     *     default="",
     *     format="string",
     *     description="transaction_id",
     *     title="transaction_id",
     * )
     *
     * @var number
     */
    private $transaction_id;
    /**
     * @OA\Property(
     *     default="0",
     *     format="number",
     *     description="use_wallet",
     *     title="use_wallet",
     * )
     *
     * @var number
     */
    private $use_wallet;


    /**
     * @OA\Property(
     *     default="0",
     *     format="number",
     *     description="address_id",
     *     title="address_id",
     * )
     *
     * @var number
     */
    private $address_id;
    /**
     * @OA\Property(
     *     default="0",
     *     format="number",
     *     description="payment_type_id",
     *     title="payment_type_id",
     * )
     *
     * @var number
     */
    private $payment_type_id;

    /**
     * @OA\Property(
     *     format="array",
     *     title="products",
     *     description="trips",
     *     type="array",
     *      @OA\Items(ref="#/components/schemas/OrderProduct"),
     * )
     *
     * @var string
     */
    private $products;

}
