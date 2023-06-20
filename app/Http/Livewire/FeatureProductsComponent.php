<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class FeatureProductsComponent extends Component
{

    public $products;
    public $tasks;
    public function mount($products)
    {
        $this->tasks=[
            ['id'=>1,"title"=>'my-title1'],
            ['id'=>2,"title"=>'my-title2'],
            ['id'=>3,"title"=>'my-title3'],
            ['id'=>4,"title"=>'my-title3'],
        ];
        $this->products = $products;
//        $this->contactnotes = $this->contacts->contactnotes()->paginate();
    }
    public function render()
    {
        return view('livewire.feature-products-component');
    }
    public function updateTaskOrder($list){

        foreach($list as $item){
            Product::find((int)$item['value'])->update(['order'=>$item['order']]);
        }
//        $this->tasks=collect($orderIds)->map(function ($id){
//            return collect($this->tasks)->where('id',$id)->first();
//        })->toArray();
    }
}
