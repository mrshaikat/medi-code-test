<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $all_product = Product::paginate(2);
        $all_product_count = Product::count();

        $all_variant = ProductVariant::groupBy('variant')->get();
        return view('products.index', [
            'products' => $all_product,
            'count' => $all_product_count,
            'variant' => $all_variant,
        ]);
    }


    /**
     * Product Search
     */

    public function search(Request $request)
    {
        $products = Product::when($request->title != null, function ($query) use ($request) {
            return $query->where('title',  $request->title);
        })->when($request->variant != null, function ($query) use ($request) {
            return $query->whereHas('productVariant', function ($q) use ($request) {
                return $q->where('variant', $request->variant);
            });
        })->when($request->price_from != null && $request->price_to != null, function ($query) use ($request) {
            return $query->whereHas('productVariantPrices', function ($q) use ($request) {
                return $q->where('price', '>=', $request->price_from)->where('price', '<=', $request->price_to);
            });
        })->when($request->date != null, function ($query) use ($request) {
            return $query->where('created_at',  $request->date);
        })->get();

        $all_product = Product::paginate(2);
        $all_product_count = Product::count();
        $all_variant = ProductVariant::groupBy('variant')->get();



        return view('products.index', [
            'products' => $all_product,
            'count' => $all_product_count,
            'variant' => $all_variant,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}