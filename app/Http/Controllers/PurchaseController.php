<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Purchase;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Manufacturer;
use App\Models\Medicine;

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
        $latest_invoice = \App\Models\Purchase::withTrashed()->latest()->max('id') + 1;
        $invoice_no = 'PR-' . str_pad((int)$latest_invoice, 6, '0', STR_PAD_LEFT);

        return Inertia::render('Purchases/Create', [
            'filters' => Request::only('search'),
            'invoice_no' => $invoice_no,
            'manufacturers' => Manufacturer::select(['id', 'name', 'location'])
                ->orderBy('name', 'asc')
                ->get()
                ->map(fn ($manufacturer) => [
                    'id' => $manufacturer->id,
                    'name' => $manufacturer->name,
                    'location' => $manufacturer->location
                ]),
        ]);
    }

    public function store(StorePurchaseRequest $request)
    {
        return dd($request->all());
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

    public function searchMedicine(\Illuminate\Http\Request $request)
    {
        return Medicine::query()
            ->orderBy('created_at', 'desc')
            ->filter(['search' => $request->input('query')])
            ->get()
            ->map(fn ($medicine) => [
                'id' => $medicine->id,
                'name' => $medicine->name,
                'strength' => $medicine->strength,
                'purchase_price' => $medicine->purchase_price,
                'selling_price' => $medicine->selling_price,
                'discount' => $medicine->discount,
            ]);
    }
}
