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
        // $productsData = $products->items();
        return view('dashboard.products.index', ['products' => $products]);
    }

    public function show()
    {
        $products = Product::all();
        return response()->json($products);
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
        $product->category_id = $request->input('category_id') ?? 1;
        $product->brand = $request->input('brand');
        $product->images = "teste";
        $product->color = $request->input('color');
        $product->variation = $request->input('variation');
        $product->quantity = $request->input('quantity');
        $product->save();
        $this->uploadImages($request, $product);

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Produto criado com sucesso!');
    }


    public function uploadImages(Request $request, $product)
    {
        $rootDirectory = 'images/products';

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

                $imagePaths[] = "$imageName";
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
