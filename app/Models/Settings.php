<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
class Settings extends Model{
    protected $table = 'settings';
    protected $fillable=['name','value'];
    public $timestamps=false;
    public static function get($name, $default = null)
    {
        if(\Cache::get('settings.'.$name)){
            return \Cache::get('settings.'.$name);
        }
        $value = self::query()->where('name', $name)->value('value');
        if ($value === null) {
            $value = $default;
        }

        \Cache::forever('settings.'.$name, $value);
        return $value;
    }

    public static function set($name, $value)
    {
        \Cache::forget('settings.'.$name);
        return self::query()->updateOrCreate([
            'name' => $name,
        ], [
            'value' => $value,
        ]);
    }

    public function key($type)
    {
        return $this->where('name', $type)->first();
    }

    public function valueOf($type , $default = null)
    {
        return (isset($this->key($type)->value)) ? $this->key($type)->value : $default;
    }

}
