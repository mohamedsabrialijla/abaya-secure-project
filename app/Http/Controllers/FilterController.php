<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Offer;
use App\Models\Type;
use App\Models\Product;
use App\Repositories\FacetedRepository;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * @var FacetedRepository
     */
    private $repository;

    public function __construct(FacetedRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        //    dd(request()->type,request()->id);
        $brandkey = null;
        $catkey = null;
        $typekey = null;
        if (!is_null(request()->type) && !is_null(request()->id)) {
            if (request()->type == 'category') {
                $catkey = request()->id;
            } elseif (request()->type == 'brand') {
                $brandkey = request()->id;
            } elseif (request()->type == 'type') {
                $typekey = request()->id;
            }
        }
        // dd($type,$id,(!is_null($type)&&!is_null($id)),$catkey,($type == 'category'));
        $products = Product::query()->paginate(6);
        $repository = $this->repository;
        $products_without_paginate = Product::with('category','store')->get();
        // return $products_without_paginate;

        return view('filter.index1', compact('repository', 'products', 'brandkey', 'catkey', 'typekey','products_without_paginate'));
    }

    // public function index1()
    // {
    //     //    dd(request()->type,request()->id);
    //     $brandkey = null;
    //     $catkey = null;
    //     $typekey = null;
    //     if (!is_null(request()->type) && !is_null(request()->id)) {
    //         if (request()->type == 'category') {
    //             $catkey = request()->id;
    //         } elseif (request()->type == 'brand') {
    //             $brandkey = request()->id;
    //         } elseif (request()->type == 'type') {
    //             $typekey = request()->id;
    //         }
    //     }
    //     // dd($type,$id,(!is_null($type)&&!is_null($id)),$catkey,($type == 'category'));
    //     $products = Product::query()->paginate(6);
    //     $repository = $this->repository;
    //     return view('filter.index1', compact('repository', 'products', 'brandkey', 'catkey', 'typekey'));
    // }

    public function allReduction()
    {
        //echo dd(request()->type,request()->id);
        $brandkey = null;
        $catkey = null;
        $typekey = null;
        // dd($type,$id,(!is_null($type)&&!is_null($id)),$catkey,($type == 'category'));
         $products = Product::with('currentReduction')->whereNotNull('last_reduction')->where('active',1)->where('flag',0)->whereReturned(null)->paginate(12);

        $repository = $this->repository;
        return view('reductions.all-reducations', compact( 'products', 'brandkey', 'catkey', 'typekey'));
    }

    public function faceted(Request $request, Product $product)
    {


        if ($request->ajax()) {
            $search = $request->get('search');
            $categories = $request->get('categories');
            $brands = $request->get('brands');
            $types = $request->get('types');
            $colors = $request->get('colors');
            $offers = $request->get('offers');

            $product = $product->newQuery()->where('is_active', true);

            if ($request->has('search') && $request->get('search') != null) {
                $product->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('brand', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('category', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('type', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('color', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            }

            if ($request->has('categories')) {

                $product->whereIn('category_id', $categories);
            }


            if ($request->has('brands')) {
                $product->whereIn('store_id', $brands);
            }

            if ($request->has('types')) {
                $product->whereHas('sizes', function($q) use ($types) {
                    $q->whereIn('size_id', $types);
                });
            }

            if ($request->has('colors')) {
                $product->whereHas('colors', function($q) use ($colors) {
                    $q->whereIn('color_id', $colors);
                });
            }

            if ($request->has('offers')) {
                $product->whereHas('offers', function ($query) use ($offers) {
                    $query->whereIn('offer_id', $offers);
                });
            }

            if ($request->has('price') && $request->get('price') != null) {
                $range = str_replace('$', '', $request->get('price'));
                $range = explode(' - ', $range);
                $product->whereBetween('sale_price', $range);
            }
// dd($request->has('sorting'),($request->has('sorting') && $request->get('sorting') != ''),$request->get('sorting'),$request->get('qty'));
            if ($request->has('sorting') && $request->get('sorting') != '') {
                $sorting = $request->get('sorting');
                if ($sorting == 'old') {
                    $product->orderBy('created_at', 'asc');
                } elseif ($sorting == 'low') {
                    $product->orderBy('sale_price', 'asc');
                } elseif ($sorting == 'high') {
                    $product->orderBy('sale_price', 'desc');
                } else {
                    $product->orderBy('created_at', 'desc');
                }
            }

            if ($request->has('qty')) {
                $qty = $request->get('qty');
                $listings = $product->paginate($qty);
            } else {
                $listings = $product->paginate(6);
            }

            // $repository = $this->repository;
            // dd($listings);

            return view('filter.products', compact('listings'))->render();
        } else {
            return redirect()->route('web.products');
        }
    }

    public function loadCat(Request $request)
    {
        $categories = $request->get('categories');
        $moreCats = Category::query()
            ->orderBy('name')
            ->offset($categories)
            ->limit(5)
            ->pluck('name', 'id');
        $result = [];
        foreach ($moreCats as $key => $cat) {
            $result[] = '<li><input class="category" name="' . $cat . '" type="checkbox" value="' . $key . '"><label for="' . $cat . '">&nbsp;&nbsp;' . $cat . '</label><span>&nbsp;(' . Category::query()->find($key)->products->count() . ')</span></li>';
        }

        return $result;
    }

    /**
     * Load more brands from storage
     * @param Request $request
     * @return array
     */
    public function loadBrand(Request $request)
    {
        $brands = $request->get('brands');
        $moreBrands = Brand::query()
            ->orderBy('name')
            ->offset($brands)
            ->limit(5)
            ->pluck('name', 'id');
        $result = [];
        foreach ($moreBrands as $key => $brand) {
            $result[] = '<li><input class="brand" name="' . $brand . '" type="checkbox" value="' . $key . '"><label for="' . $brand . '">&nbsp;&nbsp;' . $brand . '</label><span>&nbsp;(' . Brand::query()->find($key)->products->count() . ')</span></li>';
        }

        return $result;
    }

    /**
     * Load more types from storage
     * @param Request $request
     * @return array
     */
    public function loadType(Request $request)
    {
        $types = $request->get('types');
        $moreTypes = Type::query()
            ->orderBy('name')
            ->offset($types)
            ->limit(5)
            ->pluck('name', 'name');
        $result = [];
        foreach ($moreTypes as $key => $type) {
            $result[] = '<li><input class="type" name="' . $type . '" type="checkbox" value="' . $key . '"><label for="' . $type . '">&nbsp;&nbsp;' . $type . '</label><span>&nbsp;(' . Type::query()->find($key)->products->count() . ')</span></li>';
        }

        return $result;
    }

    /**
     * Load more colors from storage
     * @param Request $request
     * @return array
     */
    public function loadColor(Request $request)
    {
        $colors = $request->get('colors');
        $moreColors = Color::query()
            ->orderBy('name')
            ->offset($colors)
            ->limit(5)
            ->pluck('name', 'id');
        $result = [];
        foreach ($moreColors as $key => $color) {
            $result[] = '<li><input class="color" name="' . $color . '" type="checkbox" value="' . $key . '"><label for="' . $color . '">&nbsp;&nbsp;' . $color . '</label><span>&nbsp;(' . Color::query()->find($key)->products->count() . ')</span></li>';
        }

        return $result;
    }

    /**
     * Load more offers from storage
     * @param Request $request
     * @return array
     */
    public function loadOffer(Request $request)
    {
        $offers = $request->get('offers');
        $moreOffers = Offer::query()
            ->orderBy('name')
            ->offset($offers)
            ->limit(5)
            ->pluck('name', 'name');
        $result = [];
        foreach ($moreOffers as $key => $offer) {
            $result[] = '<li><input class="offer" name="' . $offer . '" type="checkbox" value="' . $key . '"><label for="' . $offer . '">&nbsp;&nbsp;' . $offer . '</label><span>&nbsp;(' . Offer::query()->find($key)->products->count() . ')</span></li>';
        }

        return $result;
    }

    public function get_products_by_category($id)
    {
        $query = Product::where("active", 1);
        $single_category = null;
        $products = new Collection();

        if (explode('-', $word)[0] == 'newArrival') {
            $products = $query->orderBy('created_at', 'desc')->paginate(12);
        }

        if (explode('-', $word)[0] == 'brands') {
            $products = $query->where("brand_id", explode('-', $word)[1])->paginate(12);
        }


        if (explode('-', $word)[0] == 'categories') {
            $cat_id = explode('-', $word)[1];
            $cat = Category::find($cat_id);

            if (is_null($cat->parent_id)) {
                $cats = Category::where('parent_id', $cat_id)->pluck('id');
                $products = $query->whereIn("category_id", $cats)->orWhere('category_id', $cat_id)->paginate(12);
                // dd($word,$cat_id,$cat,is_null($cat->parent_id) ,$cats,$products);
            } else {
                $products = $query->where("category_id", explode('-', $word)[1])->paginate(12);
            }
            $single_category = Category::find(explode('-', $word)[1]);
        }

        if (explode('-', $word)[0] == 'sale') {
            $products = $query->where("discount_ratio", "<>", 'null')->paginate(12);
        }

        // $repository = $this->repository;
        // return view('filter.index',compact('repository','products'));



        return view('categories', compact("categories", 'materials', 'colors', 'brands', 'single_category', 'products'));
    }
}
