<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Purchase;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;

class PurchaseController extends Controller
{
    public function index()
    {
        return Inertia::render('Purchases/Index', [
            'filters' => Request::only('search'),
            'purchases' => Purchase::with('manufacturer:id,name')
                ->orderBy('created_at', 'desc')
                ->filter(Request::only('search'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($purchase) => [
                    'id' => $purchase->id,
                    'invoice_no' => $purchase->invoice_no,
                    'purchase_date' => Carbon::parse($purchase->purchase_date)->format('M d, Y'),
                    'manufacturer' => $purchase->manufacturer->name,
                    'sub_total' => $purchase->sub_total,
                    'vat' => $purchase->vat,
                    'discount' => $purchase->discount,
                    'grand_total' => $purchase->grand_total,
                    'paid_amount' => $purchase->paid_amount,
                    'due_amount' => $purchase->due_amount,
                    'created_at' => Carbon::parse($purchase->created_at)->format('M d, Y'),
                    'updated_at' => Carbon::parse($purchase->updated_at)->format('M d, Y'),
                ])
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StorePurchaseRequest $request)
    {
        //
    }

    public function show(Purchase $purchase)
    {
        //
    }

    public function edit(Purchase $purchase)
    {
        //
    }

    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    public function destroy(Purchase $purchase)
    {
        //
    }
}
