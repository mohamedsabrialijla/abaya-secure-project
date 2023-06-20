<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Store;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use Session;

class SizeExport implements FromView
{
    public function view(): View
    {
        $id = Session()->get('store_id');
        $products = Product::where('store_id',$id)->pluck('id');
        $data = ProductSize::whereIn('product_id',$products)->get();
        $out = $data;
        return view('system_admin.products.exportsize', [
            'out'=> $out,
            'id' => $id
        ]);
    }
}
