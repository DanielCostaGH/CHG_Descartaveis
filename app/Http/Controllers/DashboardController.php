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
        $products = Product::paginate(15);
        $productsData = $products->items(); // Extrai os produtos como um array
        return view('dashboard.products.index', ['products' => $productsData]);


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
            $imageName = end($parts);
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


    public function uploadImages(Request $request, $product)
    {
        $rootDirectory = 'products';

        if (!Storage::exists($rootDirectory)) {
            Storage::makeDirectory($rootDirectory);
        }
        $productId = $product->id;
        $productDirectory = "{$rootDirectory}/$productId";

        if (!Storage::exists($productDirectory)) {
            Storage::makeDirectory($productDirectory);
        }

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $index => $image) {
                $imageName = $productId . '_' . time() . '_' . $index . '.' . $image->getClientOriginalExtension();

                $image->storeAs($productDirectory, $imageName, 'public');

                $imagePaths[] = "$productDirectory/$imageName";
            }

            $product->images = implode(';', $imagePaths);
            $product->save();
        }
    }

    public function productUpdate(ProductRequest $request, Product $product)
    {
        $product->sku = $request->input('sku') ?? 'testee';
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id') ?? 1;
        $product->brand = $request->input('brand');
        $product->color = $request->input('color');
        $product->variation = $request->input('variation');
        $product->quantity = $request->input('quantity');
        $product->save();

        $this->deleteImages($product);

        $this->uploadImages($request, $product);

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function deleteImages(Product $product)
    {
        $imagePaths = explode(';', $product->images);

        foreach ($imagePaths as $imagePath) {
            Storage::delete("public/$imagePath");
        }
    }



    public function appearence() {
        return view('dashboard.appearence.index');
    }
}
