<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Inertia\Inertia;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Responses\ProductResponse;
use App\Actions\Product\CreateNewProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Team $team)
    {
        return Inertia::render('Products/Index', [
            'products' => Product::where('team_id', $team->id)->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team)
    {
        return Inertia::render('Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Team $team, CreateNewProduct $creator)
    {
        $product = $creator->create($request->validated(), compact('team'));

        return ProductResponse::dispatch($product);
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
        return Inertia::render('Products/Show', [
            'product' => $product->load('subscriptions'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, Product $product)
    {
        return Inertia::render('Products/Edit', compact('product'));
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
        $product->update($request->validated());

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
