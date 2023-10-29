<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product; // Importe a model Product
use Illuminate\Support\Facades\Storage;

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

    public function Productstore(Request $request)
{
    // Valide os dados do formulário, se necessário

    // Crie um novo produto
    $product = new Product();
    $product->sku = $request->input('sku') ?? 'testee';
    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->category_id = $request->input('category_id') ?? 1;
    $product->brand = $request->input('brand');
    
    $colors = $request->input('color');
    $product->color = implode(';', $colors);
    
    $variations = $request->input('variation');
    $product->variation = implode(';', $variations);
    
    $product->quantity = $request->input('quantity');
    $product->status = $request->input('status');
    
    // Salve o novo produto
    $product->save();

    // Chame a função upload para lidar com o armazenamento de imagens
    $this->uploadImages($request, $product);

    return redirect()->route('product.show', ['id' => $product->id])
        ->with('success', 'Produto criado com sucesso!');
}

public function uploadImages(Request $request, $product)
{
    if ($request->hasFile('images')) {
        $imagePaths = [];
        $productId = $product->id;

        foreach ($request->file('images') as $image) {
            $imageName = $productId . '_' . time() . '.' . $image->extension();
            
            // Crie a pasta se ela não existir
            $directory = "images/products/$productId";
            Storage::makeDirectory($directory);

            // Mova o arquivo para a pasta criada
            $image->storeAs($directory, $imageName, 'public');
            $imagePaths[] = "$directory/$imageName";
        }

        $product->images = implode(';', $imagePaths);
        $product->save();
    }
}





    public function appearence()
    {
        return view('dashboard.appearence.index');
    }
}
