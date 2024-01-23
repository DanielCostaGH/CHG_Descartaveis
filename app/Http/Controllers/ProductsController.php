<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductFilterService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $filterService;

    public function __construct(ProductFilterService $filterService)
    {
        $this->filterService = $filterService;
    }


    public function index()
    {
        return (
            view('products.product_list')
        );
    }


    public function getProducts(Request $request)
    {
        $parameters = $request->all();

        if ($request->has('query')) {
            $parameters['productName'] = $request->query('query');
        }
        if ($request->has('categoryId')) {
            $parameters['selectedCategories'] = [$request->input('categoryId')];
        }

        if ($this->hasFilters($request)) {
            $products = $this->filterService->filter($parameters);
        } else {
            $products = Product::getAvailableProducts();
        }

        return response()->json($products);
    }


    protected function hasFilters(Request $request)
    {
        return $request->hasAny([
            'priceSort',
            'selectedCategories',
            'selectedColors',
            'categoryId',
        ]) || ($request->has('productName') && $request->get('productName') !== $request->get('query'));
    }



    public function search(Request $request)
    {
        $query = $request->get('query');
        $products = Product::searchByName($query);

        return response()->json($products);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (
            view('products.create')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404); // Redireciona para a página de erro 404 se o produto não for encontrado.
        }

        return view('products.product_details', compact('product'));
    }

    public function filter($id)
    {
    }


    public function getAvailableProducts()
    {
        $activeProducts = Product::getAvailableProducts();
        return response()->json($activeProducts);
    }

    public function countProducts()
    {
        $count = Product::count();
        return response()->json($count);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    //     public function getDescription($id)
    // {
    //     $product = Product::where('id', $id)->first();

    //     if (!$product) {
    //         return response()->json(['error' => 'Produto não encontrado'], 404);
    //     }
    //     return response()->json(['description' => $product->description]);
    // }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
