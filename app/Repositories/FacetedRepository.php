<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Offer;
use App\Models\Size;
use App\Models\Store;
use App\Models\Type;

class FacetedRepository
{
    /**
     * Return a collection of Category Name from storage
     * @return \Illuminate\Support\Collection
     */
    public function main_categories()
    {
        // return Category::all()->sortBy('name')->pluck('name','id');

        return Category::where('status',1)->get()->sortBy('name')->pluck('name','id');
    }

    // public function sub_categories()
    // {
    //     return Category::where('parent_id','!=',null)->get()->sortBy('parent_id')->pluck('name','id');
    // }

    /**
     * Return a collection of Type Name from storage
     * @return \Illuminate\Support\Collection
     */
    public function types()
    {
        return Size::where('status',1)->get()->sortBy('name')->pluck('name','id');
    }

    /**
     * Return a collection of Brand Name from storage
     * @return \Illuminate\Support\Collection
     */
    public function brands()
    {
        return Store::all()->sortBy('name')->pluck('name','id');
    }

    /**
     * Return a collection of Color name from storage
     * @return \Illuminate\Support\Collection
     */
    public function colors()
    {
        return Color::all()->sortBy('name')->pluck('name','id');
    }

    /**
     * Return a collection of Offers from storage
     * @return \Illuminate\Support\Collection
     */
    // public function offers()
    // {
    //     return Offer::all()->sortBy('name')->pluck('name','id');
    // }

    /**
     * Options for sort the search result
     * @return array
     */
    public function sorting()
    {
        if (app()->getLocale() == 'ar') {
            return [
                'new' => 'الأحدث',
                'old' => 'الأقدم',
                'low' => 'السعر:من الأقل للأكثر',
                'high' => 'السعر:من الأكثر للأقل'
            ];
        } else {
            return [
                'new' => 'newest',
                'old' => 'older',
                'low' => 'price: low to high',
                'high' => 'price: high to low'
            ];
        }


    }

    /**
     * Options for sort the search result by direction
     * @return array
     */
    public function direction()
    {
        if (app()->getLocale() == 'ar') {
            return [
                'asc' => 'تصاعدي',
                'desc' => 'تنازلي'
            ];
        } else {
            return [
                'asc' => 'Ascending',
                'desc' => 'Descending'
            ];
        }
    }
}
