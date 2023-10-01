<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product; // Importe a model Product

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    // Método para exibir a lista de produtos
    public function showProducts()
    {
        return view('dashboard.products.index');
    }

    // Método para a edição de produto
    public function editProduct($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            abort(404); 
        }
        
        return view('dashboard.products.edit', compact('product')); 
    }


    // Método para a criação de produto
    public function createProduct()
    {
        return view('dashboard.products.create');
    }

    public function productStore(ProductRequest $request)
    {
        $product = new Product();
        $product->sku = $request->input('sku') ?? 'testee';
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

        $imageUrls = $request->input('images');
        $imageNames = [];
        foreach ($imageUrls as $imageUrl) {
            $parts = explode('/', $imageUrl);
            $imageName = 'i' . end($parts);
            $imageNames[] = $imageName;
        }
        $product->images = implode(';', $imageNames);

        $product->category_id = $request->input('category_id') ?? 1;
        $product->brand = $request->input('brand');

        $colors = $request->input('color');
        $product->color = implode(';', $colors);

        $variations = $request->input('variation');
        $product->variation = implode(';', $variations);

        $product->quantity = $request->input('quantity');
        $product->status = $request->input('status');
        $product->save();

        return redirect()->route('product.show', ['id' => $product->id])
            ->with('success', 'Produto criado com sucesso!');
    }



    public function appearence() {
        return view('dashboard.appearence.index');
    }

}
