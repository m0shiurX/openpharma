<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use Inertia\Inertia;
use App\Http\Requests\StoreSaleRequest;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller
{

    public function index()
    {
        return Inertia::render('Sales/Index', [
            'filters' => Request::only('search'),
            'purchases' => Sale::with('customer:id,name')
                ->orderBy('created_at', 'desc')
                ->filter(Request::only('search'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($sale) => [
                    'id' => $sale->id,
                    'invoice_no' => $sale->invoice_no,
                    'sales_date' => Carbon::parse($sale->sales_date)->format('M d, Y'),
                    'customer' => $sale->customer->name,
                    'sub_total' => $sale->sub_total,
                    'vat' => $sale->vat,
                    'discount' => $sale->discount,
                    'grand_total' => $sale->grand_total,
                    'paid_amount' => $sale->paid_amount,
                    'due_amount' => $sale->due_amount,
                    'created_at' => Carbon::parse($sale->created_at)->format('M d, Y'),
                    'updated_at' => Carbon::parse($sale->updated_at)->format('M d, Y'),
                ])
        ]);
    }


    public function create()
    {
        //
    }


    public function store(StoreSaleRequest $request)
    {
        //
    }


    public function show(Sale $sale)
    {
        //
    }


    public function edit(Sale $sale)
    {
        //
    }


    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }


    public function destroy(Sale $sale)
    {
        //
    }
}
