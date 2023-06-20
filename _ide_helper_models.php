<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdminRule[] $Rules
 * @property-read int|null $rules_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin query()
 * @mixin \Eloquent
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AdminNotification
 *
 * @property int $id
 * @property string $text
 * @property int $seen
 * @property string $channel
 * @property string $event
 * @property string $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminNotification whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminNotification whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminNotification whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminNotification whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminNotification whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminNotification whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $not_data
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification whereNotData($value)
 */
	class AdminNotification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AdminRule
 *
 * @property int $id
 * @property int $admin_id
 * @property int $rule_id
 * @property int $module_id
 * @property-read \App\Models\Admin $Admin
 * @property-read \App\Models\Module $Module
 * @property-read \App\Models\Rule $Rule
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRule query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRule whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRule whereModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRule whereRuleId($value)
 * @mixin \Eloquent
 */
	class AdminRule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Area
 *
 * @property int $id
 * @property string $name_ar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name_en
 * @property int $gov_id
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserAddress[] $addressies
 * @property-read int|null $addressies_count
 * @property-read mixed $can_del
 * @property-read \App\Models\Gov $gov
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereGovId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $city_code
 * @property int $is_cash
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereCityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereIsCash($value)
 */
	class Area extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BalanceType
 *
 * @property int $id
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BalanceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BalanceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BalanceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BalanceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BalanceType whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BalanceType whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BalanceType whereType($value)
 * @mixin \Eloquent
 */
	class BalanceType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CaseGeneral
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property string $color_hex
 * @property int $color_r
 * @property int $color_g
 * @property int $color_b
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CaseGeneral newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CaseGeneral newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CaseGeneral query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CaseGeneral whereColorB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CaseGeneral whereColorG($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CaseGeneral whereColorHex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CaseGeneral whereColorR($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CaseGeneral whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CaseGeneral whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CaseGeneral whereNameEn($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 */
	class CaseGeneral extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int $status
 * @property string $logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $can_del
 * @property-read mixed $image_thumbnail
 * @property-read mixed $image_url
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\CategoryFactory factory(...$parameters)
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|Category search($request)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $products_count
 * @property-read mixed $can_del
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereStatus($value)
 * @mixin \Eloquent
 * @property string|null $hexa
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductColor[] $products
 * @method static \Illuminate\Database\Query\Builder|Color onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereHexa($value)
 * @method static \Illuminate\Database\Query\Builder|Color withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Color withoutTrashed()
 */
	class Color extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Contact
 *
 * @property int $id
 * @property string $name
 * @property string $mobile
 * @property string $email
 * @property string $title
 * @property string $details
 * @property int $user_id
 * @property int $is_artist
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereIsArtist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $message
 * @property string $user_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContactReply[] $replies
 * @property-read int|null $replies_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $user
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUserType($value)
 */
	class Contact extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Contact
 *
 * @property int $id
 * @property int $contact_id
 * @property string $reply
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply whereReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply whereContactId($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contact|null $contact
 * @method static \Illuminate\Database\Query\Builder|ContactReply onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactReply whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ContactReply withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ContactReply withoutTrashed()
 */
	class ContactReply extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property string $image
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $can_del
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $prefix
 * @property int|null $mobile_digits
 * @property string|null $currency_ar
 * @property string|null $currency_en
 * @property string|null $flag
 * @property int|null $is_default
 * @property int|null $check_start_digit
 * @property int|null $start_digit
 * @property int|null $accept_prefix
 * @property-read mixed $flag_url
 * @property-read mixed $trainers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereAcceptPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCheckStartDigit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencyAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencyEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereMobileDigits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereStartDigit($value)
 * @property string $code
 * @property string|null $phone
 * @property string|null $iso3
 * @property int|null $iso_numeric
 * @property string|null $fips
 * @property string|null $continent_code
 * @property string|null $tld
 * @property string|null $currency_code
 * @property string|null $languages
 * @property string|null $time_zone
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereContinentCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereFips($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIso3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIsoNumeric($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereTld($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Coupon
 *
 * @property int $id
 * @property int|null $store_id
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $expire_date
 * @property int|null $count_of_use
 * @property int|null $count_of_use_per_customer
 * @property int|null $discount_ratio
 * @property string|null $code
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $flag
 * @property int $show
 * @property int $limit
 * @property-read \App\Models\Store|null $designer
 * @property-read mixed $used_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon ableToUse($store = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon active()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Query\Builder|Coupon onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon show()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCountOfUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCountOfUsePerCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscountRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Coupon withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Coupon withoutTrashed()
 */
	class Coupon extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CouponProduct
 *
 * @property int $id
 * @property int $coupon_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereUpdatedAt($value)
 */
	class CouponProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string|null $avatar
 * @property string|null $name
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $dial_code
 * @property string|null $password
 * @property string|null $email_verified_at
 * @property string|null $mobile_verified_at
 * @property int|null $status
 * @property string|null $activation_code
 * @property string $last_login
 * @property string|null $fcm_token
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $promo_code
 * @property float $wallet
 * @property int $points
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerAddress[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Favorite[] $favorites
 * @property-read int|null $favorites_count
 * @property-read mixed $avatar_thumb_url
 * @property-read mixed $avatar_url
 * @property-read mixed $points_value
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Customer filter($request)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Query\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereActivationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDialCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereFcmToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMobileVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePromoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereWallet($value)
 * @method static \Illuminate\Database\Query\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Customer withoutTrashed()
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomerAddress
 *
 * @property int $id
 * @property float|null $lat
 * @property float|null $lng
 * @property string|null $name
 * @property string|null $mobile
 * @property string|null $address
 * @property int|null $customer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $type
 * @property int $is_internal
 * @property int|null $area_id
 * @property-read \App\Models\Area|null $area
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress newQuery()
 * @method static \Illuminate\Database\Query\Builder|CustomerAddress onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress whereIsInternal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CustomerAddress withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CustomerAddress withoutTrashed()
 */
	class CustomerAddress extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DesignerSearchLog
 *
 * @property int $id
 * @property string|null $text
 * @property int $results_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DesignerSearchLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DesignerSearchLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DesignerSearchLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|DesignerSearchLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DesignerSearchLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DesignerSearchLog whereResultsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DesignerSearchLog whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DesignerSearchLog whereUpdatedAt($value)
 */
	class DesignerSearchLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DeviceKey
 *
 * @property int $id
 * @property string $d_key
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceKey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceKey newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceKey query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceKey whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceKey whereDKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceKey whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceKey whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceKey whereUserId($value)
 * @mixin \Eloquent
 */
	class DeviceKey extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Favorite
 *
 * @property int $id
 * @property string $content_type
 * @property int $content_id
 * @property int|null $customer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $content
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite query()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereContentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereUpdatedAt($value)
 */
	class Favorite extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GlobalNotification
 *
 * @property int $id
 * @property string $title
 * @property string $message
 * @property int $system_admin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GlobalNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GlobalNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GlobalNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GlobalNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GlobalNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GlobalNotification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GlobalNotification whereSystemAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GlobalNotification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GlobalNotification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class GlobalNotification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Gov
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserAddress[] $addressies
 * @property-read int|null $addressies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Area[] $areas
 * @property-read int|null $areas_count
 * @property-read mixed $can_del
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gov newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gov newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gov query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gov whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gov whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gov whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gov whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gov whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gov whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gov whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Area[] $cities
 * @property-read int|null $cities_count
 */
	class Gov extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Module
 *
 * @property int $id
 * @property string $name
 * @property string|null $nameAr
 * @property int $can1
 * @property int $can2
 * @property int $can3
 * @property int $can4
 * @property int $can5
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdminRule[] $AdminModule
 * @property-read int|null $admin_module_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module whereCan1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module whereCan2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module whereCan3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module whereCan4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module whereCan5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Module whereNameAr($value)
 * @mixin \Eloquent
 * @property string|null $namear
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereNamear($value)
 */
	class Module extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\NotificationText
 *
 * @property int $id
 * @property string $notification_key
 * @property string $title_ar
 * @property string $title_en
 * @property string $message_ar
 * @property string $message_en
 * @property string $data_to_send
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserNotification $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationText newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationText newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationText query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationText whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationText whereDataToSend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationText whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationText whereMessageAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationText whereMessageEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationText whereNotificationKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationText whereTitleAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationText whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationText whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class NotificationText extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Offer
 *
 * @property int $id
 * @property string $image
 * @property int $clickable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereClickable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUpdatedAt($value)
 */
	class Offer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OfferProduct
 *
 * @property int $id
 * @property int $offer_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereUpdatedAt($value)
 */
	class OfferProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string $mobile
 * @property float $total_price
 * @property int $case_id
 * @property string|null $cancel_reson
 * @property int $address_id
 * @property int $tax_ratio
 * @property float $tax_price
 * @property int $payment_type
 * @property int $transaction_id
 * @property int $is_paid
 * @property float $products_price
 * @property float $delivery_price
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserAddress $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserBalance[] $balances
 * @property-read int|null $balances_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderCase[] $cases
 * @property-read int|null $cases_count
 * @property-read mixed $created_text
 * @property-read mixed $nameid
 * @property-read \App\Models\PaymentType $paymentType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\OrderCase $status
 * @property-read \App\Models\Transaction $transaction
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order accepted()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order canceled()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order done()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order new()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order notPaid()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order onDelivery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCancelReson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeliveryPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereProductsPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTaxPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTaxRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $invoice_number
 * @property int|null $customer_id
 * @property float|null $sub_total_1
 * @property float|null $discount
 * @property float|null $sub_total_2
 * @property float|null $tax
 * @property float|null $delivery_cost
 * @property float $total
 * @property string|null $cancel_reason
 * @property string|null $bill_file_name
 * @property int|null $payment_type_id
 * @property int $use_wallet
 * @property float|null $wallet_amount
 * @property float|null $app_commission_ratio
 * @property float|null $app_commission
 * @property string|null $promo_code
 * @property int|null $referral_customer_id
 * @property float|null $discount_ratio
 * @property string|null $shipment_id
 * @property float $cod_amount
 * @property int $replaced
 * @property int $replacement_fee
 * @property string|null $tamara
 * @property string|null $tabby
 * @property-read \App\Models\Customer|null $customer
 * @property-read mixed $first_product_name
 * @property-read mixed $invoice_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderStatusLog[] $statusLog
 * @property-read int|null $status_log_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAppCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAppCommissionRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCodAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDiscountRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePromoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereReferralCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereReplaced($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereReplacementFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShipmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSubTotal1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSubTotal2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTabby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTamara($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUseWallet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereWalletAmount($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderCase
 *
 * @property int $id
 * @property int $order_id
 * @property int $case_id
 * @property int $admin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CaseGeneral $case
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $text_ar
 * @property string|null $text_en
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCase whereTextAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCase whereTextEn($value)
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string|null $hex_color
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $details_ar
 * @property string|null $details_en
 * @property string|null $notification_title
 * @property string|null $notification_text
 * @property-read mixed $details
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Query\Builder|OrderCase onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCase whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCase whereDetailsAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCase whereDetailsEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCase whereHexColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCase whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCase whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCase whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCase whereNotificationText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCase whereNotificationTitle($value)
 * @method static \Illuminate\Database\Query\Builder|OrderCase withTrashed()
 * @method static \Illuminate\Database\Query\Builder|OrderCase withoutTrashed()
 */
	class OrderCase extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderProduct
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $qty
 * @property float $item_price
 * @property float $price
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereItemPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereQty($value)
 * @mixin \Eloquent
 * @property int $store_id
 * @property int|null $size_id
 * @property int|null $color_id
 * @property int|null $coupon_id
 * @property int|null $discount_ratio
 * @property float|null $discount
 * @property float|null $total
 * @property int $is_returned
 * @property float|null $total_before_discount
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Color|null $color
 * @property-read \App\Models\Coupon|null $coupon
 * @property-read \App\Models\Store|null $designer
 * @property-read \App\Models\Size|null $size
 * @method static \Illuminate\Database\Query\Builder|OrderProduct onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereDiscountRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereIsReturned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereTotalBeforeDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|OrderProduct withTrashed()
 * @method static \Illuminate\Database\Query\Builder|OrderProduct withoutTrashed()
 */
	class OrderProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderStatusLog
 *
 * @property int $id
 * @property int|null $case_id
 * @property int|null $order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OrderCase|null $case
 * @property-read \App\Models\Order|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatusLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatusLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatusLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatusLog whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatusLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatusLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatusLog whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatusLog whereUpdatedAt($value)
 */
	class OrderStatusLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Page
 *
 * @property int $id
 * @property string $title_ar
 * @property string $title_en
 * @property string $text_ar
 * @property string $text_en
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTextAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTextEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTitleAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PasswordReset
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset query()
 * @mixin \Eloquent
 */
	class PasswordReset extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentType
 *
 * @property int $id
 * @property string $name
 * @property string $name_en
 * @property string $icon
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType whereNameEn($value)
 * @mixin \Eloquent
 * @property string|null $name_ar
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property float $ratio
 * @property-read mixed $icon_url
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereUpdatedAt($value)
 */
	class PaymentType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property string $details_ar
 * @property string $details_en
 * @property string|null $howtouse_ar
 * @property string|null $howtouse_en
 * @property int $category_id
 * @property int $brand_id
 * @property float $price
 * @property float $discount_ratio
 * @property int $status
 * @property int $is_offer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserFavorite[] $favorite
 * @property-read int|null $favorite_count
 * @property-read mixed $can_del
 * @property-read mixed $has_discount
 * @property-read mixed $image
 * @property-read mixed $image_thumbnail
 * @property-read mixed $image_url
 * @property-read mixed $in_favorite
 * @property-read mixed $real_price
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $orders
 * @property-read int|null $orders_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDetailsAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDetailsEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDiscountRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereHowtouseAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereHowtouseEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereIsOffer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\ProductImage|null $def_image
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @property int|null $store_id
 * @property int $show_in_slider
 * @property int $is_feature
 * @property int $is_active
 * @property float|null $sale_price
 * @property string|null $annotation_ar
 * @property string|null $annotation_en
 * @property string|null $feature_image
 * @property int|null $order
 * @property string|null $slider_image
 * @property int $cod
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Color[] $colors
 * @property-read int|null $colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Coupon[] $coupons
 * @property-read int|null $coupons_count
 * @property-read \App\Models\Store|null $designer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Favorite[] $favorites
 * @property-read int|null $favorites_count
 * @property-read mixed $annotation
 * @property-read mixed $feature_image_url
 * @property-read mixed $slider_image_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductSize[] $productSizes
 * @property-read int|null $product_sizes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Property[] $properties
 * @property-read int|null $properties_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Size[] $sizes
 * @property-read int|null $sizes_count
 * @property-read \App\Models\Store|null $store
 * @method static \Illuminate\Database\Eloquent\Builder|Product search($request)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAnnotationAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAnnotationEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFeatureImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShowInSlider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSliderImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStoreId($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductColor
 *
 * @property int $id
 * @property int $product_id
 * @property int $color_id
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Color $color
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereColorId($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|ProductColor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductColor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductColor withoutTrashed()
 */
	class ProductColor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductImage
 *
 * @property int $id
 * @property int $product_id
 * @property string $image
 * @property int $is_main
 * @property-read mixed $image_thumbnail
 * @property-read mixed $image_url
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereIsMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereProductId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\ImageType $typeOB
 * @method static \Database\Factories\ProductImageFactory factory(...$parameters)
 */
	class ProductImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductProperty
 *
 * @property int $id
 * @property int $product_id
 * @property int $property_id
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Property $property
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereValueAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereValueEn($value)
 * @mixin \Eloquent
 * @property string|null $value_ar
 * @property string|null $value_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|ProductProperty onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductProperty withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductProperty withoutTrashed()
 */
	class ProductProperty extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductSearchLog
 *
 * @property int $id
 * @property string|null $text
 * @property int $results_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSearchLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSearchLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSearchLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSearchLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSearchLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSearchLog whereResultsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSearchLog whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSearchLog whereUpdatedAt($value)
 */
	class ProductSearchLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductSize
 *
 * @property int $id
 * @property int $product_id
 * @property int $size_id
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Size $size
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereSizeId($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stock[] $stock
 * @property-read int|null $stock_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereUpdatedAt($value)
 */
	class ProductSize extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property string $key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $products_count
 * @property-read mixed $can_del
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereStatus($value)
 * @mixin \Eloquent
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @method static \Illuminate\Database\Query\Builder|Property onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Property withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Property withoutTrashed()
 */
	class Property extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReferralLog
 *
 * @property int $id
 * @property int $customer_id
 * @property int $reference_customer__id
 * @property string $promo_code
 * @property string $status
 * @property int $reference_customer_points
 * @property float|null $reference_customer_wallet
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLog whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLog wherePromoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLog whereReferenceCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLog whereReferenceCustomerPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLog whereReferenceCustomerWallet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLog whereUpdatedAt($value)
 */
	class ReferralLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Rule
 *
 * @property int $id
 * @property string $nameAr
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdminRule[] $AdminRule
 * @property-read int|null $admin_rule_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rule query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rule whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rule whereNameAr($value)
 * @mixin \Eloquent
 * @property string|null $namear
 * @method static \Illuminate\Database\Eloquent\Builder|Rule whereNamear($value)
 */
	class Rule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Settings
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereValue($value)
 * @mixin \Eloquent
 * @property int $show_edit
 * @property int $tab_id
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereShowEdit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereTabId($value)
 */
	class Settings extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $products_count
 * @property-read mixed $can_del
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Size newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Size newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Size query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Size whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Size whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Size whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Size whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Size whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Size whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Size whereStatus($value)
 * @mixin \Eloquent
 * @property string|null $value
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductSize[] $products
 * @method static \Illuminate\Database\Query\Builder|Size onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Size whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|Size withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Size withoutTrashed()
 */
	class Size extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Slider
 *
 * @property int $id
 * @property string $image
 * @property int $clickable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereClickable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedAt($value)
 */
	class Slider extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SliderImage
 *
 * @property int $id
 * @property string|null $name
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_url
 * @method static \Illuminate\Database\Eloquent\Builder|SliderImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SliderImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SliderImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|SliderImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SliderImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SliderImage whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SliderImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SliderImage whereUpdatedAt($value)
 */
	class SliderImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SliderProduct
 *
 * @property int $id
 * @property int $slider_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\Slider|null $slider
 * @method static \Illuminate\Database\Eloquent\Builder|SliderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SliderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SliderProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|SliderProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SliderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SliderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SliderProduct whereSliderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SliderProduct whereUpdatedAt($value)
 */
	class SliderProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SplashImage
 *
 * @property int $id
 * @property string|null $name
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_url
 * @method static \Illuminate\Database\Eloquent\Builder|SplashImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SplashImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SplashImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|SplashImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SplashImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SplashImage whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SplashImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SplashImage whereUpdatedAt($value)
 */
	class SplashImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Stock
 *
 * @property int $id
 * @property string $type
 * @property int $product_size_id
 * @property int|null $order_id
 * @property int|null $order_product_id
 * @property int $qty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $reason
 * @property-read mixed $type_label
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\OrderProduct|null $orderProduct
 * @property-read \App\Models\ProductSize|null $productSize
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereOrderProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereProductSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereUpdatedAt($value)
 */
	class Stock extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Store
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property string|null $mobile
 * @property int|null $is_wholesale
 * @property string|null $whatsapp
 * @property string|null $instagram
 * @property string|null $snapchat
 * @property int $status
 * @property string|null $logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $return_policy_ar
 * @property string|null $return_policy_en
 * @property float $commission
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Coupon[] $coupons
 * @property-read int|null $coupons_count
 * @property-read mixed $can_del
 * @property-read mixed $image
 * @property-read mixed $image_thumbnail
 * @property-read mixed $instagram_username
 * @property-read mixed $name
 * @property-read int|null $products_count
 * @property-read mixed $return_policy
 * @property-read mixed $snapchat_username
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|Store newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store newQuery()
 * @method static \Illuminate\Database\Query\Builder|Store onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Store query()
 * @method static \Illuminate\Database\Eloquent\Builder|Store search($request)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereIsWholesale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereReturnPolicyAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereReturnPolicyEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereSnapchat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereWhatsapp($value)
 * @method static \Illuminate\Database\Query\Builder|Store withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Store withoutTrashed()
 */
	class Store extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property string $transaction_id
 * @property string $type
 * @property int $payment_type
 * @property int $user_id
 * @property float $amount
 * @property string $image
 * @property int $status
 * @property string|null $cancel_reson
 * @property string $bank_id
 * @property string $bank_response
 * @property string $bank_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $redirect_url
 * @property-read \App\Models\Order $order
 * @property-read \App\User $user
 * @property-read \App\Models\UserBalance $user_balance
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereBankCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereBankResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereCancelReson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $cancel_reason
 * @property int|null $order_id
 * @property string|null $payment_id
 * @property string|null $tranid
 * @property string|null $result
 * @property string|null $postdate
 * @property string|null $auth
 * @property string|null $ref
 * @property string|null $responce_json
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePostdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereResponceJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTranid($value)
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserAddress
 *
 * @property int $id
 * @property int $user_id
 * @property int $gov_id
 * @property int $area_id
 * @property string $block
 * @property string|null $street
 * @property string|null $sub_street
 * @property string|null $build_or_house
 * @property string|null $home_number
 * @property string $build_number
 * @property string|null $floor
 * @property string|null $flat
 * @property string|null $full_address
 * @property float|null $lat
 * @property float|null $lng
 * @property int $saved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Area $area
 * @property-read mixed $address_text
 * @property-read \App\Models\Gov $gov
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereBlock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereBuildNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereBuildOrHouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereFlat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereFullAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereGovId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereHomeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereSaved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereSubStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereUserId($value)
 * @mixin \Eloquent
 * @property string $address_name
 * @property string|null $notes
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereAddressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereNotes($value)
 */
	class UserAddress extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserBalance
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $order_id
 * @property float $amount
 * @property int|null $type_id
 * @property string $transaction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\BalanceType|null $Btype
 * @property-read mixed $is_alone
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\Transaction $transaction
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalance query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalance whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalance whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalance whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalance whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalance whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalance whereUserId($value)
 * @mixin \Eloquent
 */
	class UserBalance extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserBalanceAdd
 *
 * @property int $id
 * @property int $user_id
 * @property int $transaction_id
 * @property int $payment_type
 * @property float $amount
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PaymentType $paymentType
 * @property-read \App\Models\Transaction $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalanceAdd newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalanceAdd newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalanceAdd query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalanceAdd whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalanceAdd whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalanceAdd whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalanceAdd wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalanceAdd whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalanceAdd whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalanceAdd whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBalanceAdd whereUserId($value)
 * @mixin \Eloquent
 */
	class UserBalanceAdd extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserFavorite
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserFavorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserFavorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserFavorite query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserFavorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserFavorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserFavorite whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserFavorite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserFavorite whereUserId($value)
 * @mixin \Eloquent
 * @property string $content_type
 * @property int $content_id
 * @property int|null $customer_id
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavorite whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavorite whereContentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavorite whereCustomerId($value)
 */
	class UserFavorite extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserNotification
 *
 * @property int $id
 * @property int $user_id
 * @property int $key_id
 * @property int $notification_id
 * @property int $global_id
 * @property string $data
 * @property string $firebase_response
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $message
 * @property-read mixed $title
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotification whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotification whereFirebaseResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotification whereNotificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotification whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\GlobalNotification|null $globalNot
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereGlobalId($value)
 */
	class UserNotification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WorkEvent
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $color
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkEvent whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkEvent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkEvent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class WorkEvent extends \Eloquent {}
}

namespace App{
/**
 * App\SystemAdmin
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string $password
 * @property int $status
 * @property string|null $avatar
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdminRule[] $Rules
 * @property-read int|null $rules_count
 * @property-read mixed $image_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemAdmin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemAdmin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemAdmin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemAdmin whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemAdmin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemAdmin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemAdmin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemAdmin whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemAdmin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemAdmin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemAdmin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemAdmin whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemAdmin whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $fcm_token
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|SystemAdmin permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemAdmin role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemAdmin whereFcmToken($value)
 */
	class SystemAdmin extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $mobile
 * @property string $password
 * @property string $pne
 * @property int $status
 * @property string|null $avatar
 * @property string|null $activation_code
 * @property string $token
 * @property string|null $last_login
 * @property string|null $remember_token
 * @property int $see_notifications
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float $balance
 * @property float|null $lat
 * @property float|null $lng
 * @property string|null $device_name
 * @property string|null $device_type
 * @property string|null $expiration_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserAddress[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserBalance[] $balances
 * @property-read int|null $balances_count
 * @property-read \App\Models\DeviceKey $device
 * @property-read mixed $activation_code_e
 * @property-read mixed $device_key
 * @property-read mixed $image
 * @property-read mixed $image_thumbnail
 * @property-read mixed $neg_balance
 * @property-read mixed $notification_count
 * @property-read mixed $pos_balance
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserNotification[] $notifies
 * @property-read int|null $notifies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereActivationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeviceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeviceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereExpirationAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSeeNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $email_verified_at
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeviceKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 */
	class User extends \Eloquent {}
}

