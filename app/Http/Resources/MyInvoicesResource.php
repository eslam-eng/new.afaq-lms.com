<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyInvoicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $domain = "https://";
        else
            $domain = "http://";
        // Append the host(domain name, ip) to the domain.
        $domain .= $_SERVER['HTTP_HOST'];
        $status ='';
        if($this->status && !$this->approved){
            $status = trans('afaq.invoice_wait_approveal');
        }elseif($this->status && $this->approved){
            $status = trans('afaq.invoice_approved');
        }
        return [
            'id' => $this->id ?? null,
            'payment_number' => $this->payment_number ?? null,
            'transaction' => $this->transaction ?? null,
            'amount' => $this->amount ?? null,
            'status' => $status,
            'has_bank_invoice' => $this->payment_invoices ? 1 : 0,
            'approved' => $this->approved ?? 0,
            'courses' => $this->payment_details->map(function ($i) {
                if($i->course->has_exclusive_mobile) $i['final_price']=0;
                return [
                    'course_id' => $i['course_id'] ?? null,
                    'name' =>  $i['course_name_' . app()->getLocale()]  ?? null,
                    'price' =>  $i['final_price']  ? get_price($i['final_price']) : null,
                ];
            }),
            'qr_image' => $this->qr_image ?? null,
            'provider' => $this->provider,
            'link' => $domain . '/ar/invoice/' . $this->id,
            'wallet' => $this->wallet ? true : false,
            'wallet_discount' => $this->wallet_discount ?? null,
            'created_at' => $this->created_at ? date('Y-m-d', strtotime($this->created_at)) : null
        ];
    }
}
