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

        $product->images = "iTeste";
        $imageUrls = $request->input('images');
        $imageNames = [];

        $product->category_id = $request->input('category_id') ?? 1;
        $product->brand = $request->input('brand');

        $colors = $request->input('color');
        $product->color = implode(';', $colors);

        $variations = $request->input('variation');
        $product->variation = implode(';', $variations);

        $product->quantity = $request->input('quantity');
        $product->status = $request->input('status');
        $product->save();

        // Obtenha o ID do produto após salvar
        $productId = $product->id;

        // Crie a pasta com o nome do ID do produto
        $productImagePath = public_path("images/{$productId}");
        if (!is_dir($productImagePath)) {
            mkdir($productImagePath, 0755, true);
        }

        // Agora mova as imagens para a pasta recém-criada
        foreach ($imageUrls as $imageUrl) {
            $parts = explode('/', $imageUrl);
            $imageName = 'i' . end($parts);
            $newImageName = "{$productId}/{$imageName}";
            $imageNames[] = $newImageName;

            // Copie a imagem para a pasta do produto
            copy(public_path($imageUrl), public_path("images/{$newImageName}"));
        }

        // Atualize os nomes das imagens no produto, se necessário
        $product->images = implode(';', $imageNames);
        $product->save();

        return redirect()->route('product.show', ['id' => $product->id])
            ->with('success', 'Produto criado com sucesso!');
    }




    public function appearence() {
        return view('dashboard.appearence.index');
    }

}
