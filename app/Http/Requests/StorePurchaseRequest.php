<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "invoice_no" => ['required', 'string'],
            "purchase_date" => ['date', 'required'],
            "manufacturer_id" => ['exists:manufacturers,id'],
            "sub_total" => ['numeric', 'required'],
            "vat" => ['numeric', 'required'],
            "discount" => ['numeric', 'required'],
            "grand_total" => ['numeric', 'required'],
            "paid_amount" => ['numeric', 'required'],
            "due_amount" => ['numeric', 'required'],
            "purchase_items.*.id" => ['exists:medicines,id'],
            "purchase_items.*.batch_id" => ['string', 'required'],
            "purchase_items.*.expiry_date" => ['date', 'after:tomorrow', 'required'],
            "purchase_items.*.quantity" => ['numeric', 'required'],
            "purchase_items.*.purchase_price" => ['numeric', 'required'],
            "purchase_items.*.selling_price" => ['numeric', 'required'],
            "purchase_items.*.discount" => ['numeric', 'required'],
            "purchase_items.*.total_price" => ['numeric', 'required'],
        ];
    }
}
