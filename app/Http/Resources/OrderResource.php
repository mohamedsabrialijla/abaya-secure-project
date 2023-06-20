<?php

namespace App\Http\Resources;

use App\Http\Resources\CustomerAddressResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $type=@ $this->paymentType->name;

        return [
            'id' => $this->id,
            'create_text' => $this->created_text,
            'created_at' => $this->created_at->toDateTimeString(),
            'status'=>OrderCaseResource::make($this->status),
            'name' => @$this->name,
            'customer' => CustomerResource::make($this->customer),
            'address' => CustomerAddressResource::make($this->address),
            'tax_ratio' =>(float) $this->tax_ratio,
            'sub_total_1' => $this->sub_total_1,
            'discount' => $this->discount,
            'sub_total_2' => $this->sub_total_2,
            'tax' => $this->tax,
            'delivery_cost' => $this->delivery_cost,
            'total' => $this->total,
            'invoice_url' => $this->invoice_url,
            'use_wallet' => $this->use_wallet,
            'used_wallet_amount' => $this->wallet_amount,
            'promo_code' => $this->promo_code,
            'cod_amount' => $this->cod_amount,
            'products' => OrderProductResource::collection($this->products),
            'status_Log' => OrderStatusLogResource::collection($this->statusLog),
            'payment_type' => $this->payment_type_id,
            'payment_id' => @$this->transaction->tranid,
            'taby_payment_ref' => @$this->transaction->ref,
//            'transaction_url' => $this->transaction && $this->case_id==1?$this->transaction->redirect_url:'',

        ];
    }
}
