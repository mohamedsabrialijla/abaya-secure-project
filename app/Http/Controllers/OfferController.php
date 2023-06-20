<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\OfferProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:activate_stores|view_stores|add_stores|edit_stores|delete_stores,system_admin', ['only' => ['index', 'create']]);
        $this->middleware('permission:add_stores,system_admin', ['only' => ['create', 'showCreateView']]);
        $this->middleware('permission:edit_stores,system_admin', ['only' => ['showUpdateView', 'update']]);
        $this->middleware('permission:delete_stores,system_admin', ['only' => ['delete']]);
    }

    public function index(Request $request)
    {

        $out = Offer::orderBy('created_at', 'DESC')->get();

        return view('system_admin.offers.index', compact('out'));
    }

    public function view(Offer $offer)
    {
        $out = $offer;
        return view('system_admin.offers.view', compact('out'));
    }
    public function showCreateView()
    {
        $cats = Category::where('id', '>', 0)->get();
        $products = Product::where('is_active', true)->get();
        return view('system_admin.offers.create', compact('cats', 'products'));
    }


    public function create(Request $request)
    {

        $this->validate($request, [
            'image' => 'required'
        ]);

        $object = new Offer();
        $object->image = $request->image;
        $object->clickable = $request->clickable;
        $object->save();
        \HELPER::deleteUnUsedFile([$request->image]);

        if (!empty($request->products)) {
            # code...

            foreach ($request->products as $product) {
                $d = new OfferProduct();
                $d->offer_id = $object->id;
                $d->product_id = $product;
                $d->save();
            }
        }
        if (!empty($request->cats)) {
            foreach ($request->cats as $cat) {
                $c = Category::find($cat);
                foreach ($c->products as $value) {
                    $d1 = new OfferProduct();
                    $d1->offer_id = $object->id;
                    $d1->product_id = $value->id;
                    $d1->save();
                }
            }
        }


        flash('تمت الاضافة بنجاح');

        return redirect(route('system.offers.index'));
    }

    public function showUpdateView($id)
    {
        $cats = Category::where('id', '>', 0)->get();
        $products = Product::where('is_active', true)->get();

        $out = Offer::find($id);
        return view('system_admin.offers.update', compact('out', 'cats', 'products'));
    }


    public function update(Request $request, $id)
    {
        $object = Offer::find($id);
        $object->image = $request->image?? '';
        $object->clickable = $request->clickable;
        $object->save();
        \HELPER::deleteUnUsedFile([$request->image]);

        if (!empty($request->products)) {
            # code...
            $old = OfferProduct::where('offer_id',$id)->delete();

            foreach ($request->products as $product) {
                $d = new OfferProduct();
                $d->offer_id = $object->id;
                $d->product_id = $product;
                $d->save();
            }
        }
        if (!empty($request->cats)) {
            foreach ($request->cats as $cat) {
                $c = Category::find($cat);
                foreach ($c->products as $value) {
                    $d1 = new OfferProduct();
                    $d1->offer_id = $object->id;
                    $d1->product_id = $value->id;
                    $d1->save();
                }
            }
        }

        flash('تم التعديل بنجاح');

        return redirect(route('system.offers.index'));
    }

    public function delete(Request $request)
    {
        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;
        }
        foreach ($ids as $id) {
            $s = Offer::find($id);
            $j = 0;

            $s->delete();
            $j++;
        }
        return ['done' => $j];
    }
}
