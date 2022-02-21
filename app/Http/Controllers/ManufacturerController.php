<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;


class ManufacturerController extends Controller
{
    public function index()
    {
        return Inertia::render('Manufacturers/Index', [
            'filters' => Request::only('search'),
            'manufacturers' => Manufacturer::orderBy('created_at', 'desc')
                ->filter(Request::only('search'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($manufacturer) => [
                    'id' => $manufacturer->id,
                    'name' => $manufacturer->name,
                    'location' => $manufacturer->location,
                    'contact_name' => $manufacturer->contact_name,
                    'contact_tel' => $manufacturer->contact_tel,
                    'created_at' => Carbon::parse($manufacturer->created_at)->format('M d, Y'),
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Manufacturers/Create');
    }

    public function store(StoreManufacturerRequest $request)
    {
        Manufacturer::create($request->validated());
        return Redirect::route('manufacturers.index')->with('success', 'Manufacturer created.');
    }

    public function show(Manufacturer $manufacturer)
    {
        //
    }

    public function edit(Manufacturer $manufacturer)
    {
        //
    }

    public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        //
    }

    public function destroy(Manufacturer $manufacturer)
    {
        //
    }
}
