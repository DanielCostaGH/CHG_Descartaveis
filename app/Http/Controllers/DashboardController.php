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

    // Método para exibir o formulário de edição de produto
    public function editProduct($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            abort(404); 
        }
        
        return view('dashboard.products.edit', compact('product')); 
    }

    public function appearence() {
        return view('dashboard.appearence.index');
}

}
