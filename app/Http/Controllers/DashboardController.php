<?php

namespace App\Http\Controllers;

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

    public function appearence() {
        return view('dashboard.appearence.index');
}

}
