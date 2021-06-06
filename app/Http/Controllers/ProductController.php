<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Inertia\Inertia;
use App\Models\Product;
use App\Filters\ProductFilter;
use App\Http\Requests\ProductRequest;
use App\Http\Responses\ProductResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Team
     * @param \App\Filters\ProductFilter
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Team $team, ProductFilter $filters)
    {
        return Inertia::render('Products/Index', [
            'products' => $team->products()->filter($filters)->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team)
    {
        return Inertia::render('Products/Create', compact('team'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Team $team)
    {
        return ProductResponse::dispatch();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team, Product $product)
    {
        return Inertia::render('Products/Show', compact('team', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, Product $product)
    {
        return Inertia::render('Products/Edit', compact('team', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product      $product
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Team $team, Product $product)
    {
        return ProductResponse::dispatch($product->fresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team, Product $product)
    {
    }
}
