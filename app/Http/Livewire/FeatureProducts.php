<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class FeatureProducts extends Component
{
    public $products;



    public function render()
    {
        $this->products=Product::orderBy('order','asc')->where('is_feature',true)->get();
        return view('livewire.feature-products');
    }

    public function updateTaskOrder($list){

        foreach($list as $item){
            Product::find((int)$item['value'])->update(['order'=>$item['order']]);
        }
//        $this->products= collect( $this->products)->sortBy('order');
//        $this->tasks=collect($orderIds)->map(function ($id){
//            return collect($this->tasks)->where('id',$id)->first();
//        })->toArray();
    }
}
