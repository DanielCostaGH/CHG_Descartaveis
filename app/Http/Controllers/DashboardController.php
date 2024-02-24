<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product; // Importe a model Product
use App\Models\ProductColors;
use Illuminate\Support\Facades\Storage;
use Mockery\Undefined;

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

    // Método para a criação de produto
    public function createProduct()
    {
        return view('dashboard.products.create');
    }

    public function productStore(ProductRequest $request)
    {
        $product = new Product();
        $product->sku           = $request->input('sku') ?? 'testee';
        $product->name          = $request->input('name');
        $product->description   = $request->input('description');
        $product->price         = $request->input('price');
        $product->category_id   = $request->input('category_id');
        $product->brand         = $request->input('brand');
        $product->images        = "teste";
        $product->variation     = implode(';', $request->variation);
        $product->height        = $request->input('height');
        $product->width         = $request->input('width');
        $product->length        = $request->input('length');
        $product->weight        = $request->input('weight');
        $product->quantity      = $request->input('quantity');
        $product->status        = $request->input('status');
        $product->save();

        foreach ($request->colors as $color) {
            $productColors = new ProductColors;
            $productColors->product_id = $product->id;
            $productColors->color_id = $color;
            $productColors->save();
        }


        $this->uploadImages($request, $product);

        // return redirect()->route('dashboard.products.index')
        //     ->with('success', 'Produto criado com sucesso!');
    }


    public function editProduct($id)
    {
        $product = Product::find($id);
        $productColors = ProductColors::where('product_id', $id)->get();
        $productColor = [];

        foreach ($productColors as $color) {
            $productColor[] = $color->color_id;
        }
        $productColorString = implode(';', $productColor);
        $product->colors = $productColorString;
        if (!$product) {
            abort(404);
        }

        return view('dashboard.products.edit', compact('product'));
    }

    public function productUpdate(ProductUpdateRequest $request)
    {
        $productId = $request->id;

        $product = Product::find($productId);
        $product->sku           = $request->input('sku') ?? 'teste';
        $product->name          = $request->input('name');
        $product->description   = $request->input('description');
        $product->price         = $request->input('price');
        $product->category_id   = $request->input('category_id');
        $product->brand         = $request->input('brand');
        $product->height        = $request->input('height');
        $product->width         = $request->input('width');
        $product->length        = $request->input('length');
        $product->weight        = $request->input('weight');
        $deletedImages          = $request->input('deletedImages');
        $product->variation     = implode(';', $request->variation);
        $product->quantity      = $request->input('quantity');

        $product->save();

        if ($request->colors){
            self::updateColors($product, $request->input('colors'));
        }

        if($request->input('images')[0] !== 'undefined') {
            $this->uploadImages($request, $product);
        }

        if ($request->has('deletedImages')) {
            $this->deleteImages($product, $deletedImages);
        }
        return response()->json(['message' => 'Produto atualizado com sucesso!']);
    }


    public function updateColors(Product $product, array $newColorIds)
    {
        
        $existingColorIds = ProductColors::where('product_id', $product->id)->get()->pluck('color_id')->toArray();

        $colorsToRemove = array_diff($existingColorIds, $newColorIds);

        if (!empty($colorsToRemove)) {
            ProductColors::where('product_id', $product->id)
                ->whereIn('color_id', $colorsToRemove)
                ->delete();
        }

        foreach ($newColorIds as $colorId) {
            $existingColor = ProductColors::where('product_id', $product->id)
                ->where('color_id', $colorId)
                ->first();

            if (!$existingColor) {
                $productColor = new ProductColors();
                $productColor->product_id = $product->id;
                $productColor->color_id = $colorId;
                $productColor->save();
            }
        }
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

        if ($request->hasFile('newImages')) {
            $imagePaths = [];
            foreach ($request->file('newImages') as $index => $image) {
                $imageName = $productId . '_' . time() . '_' . $index . '.' . $image->getClientOriginalExtension();

                $image->storeAs($productDirectory, $imageName, 'public');

                $imagePaths[] = "$imageName";
            }

            $product->images = $product->images . ';' . implode(';', $imagePaths);
            $product->save();
        }
    }

    public function deleteImages(Product $product, $deletedImages)
    {
        $imagePaths = explode(';', $product->images);

        $newPaths = array_diff($imagePaths, $deletedImages);

        foreach ($deletedImages as $deletedImage) {
            Storage::disk('public')->delete("/images/products/{$product->id}/{$deletedImage}");
        }

        $product->images = implode(';', $newPaths);
        $product->save();
    }


    public function appearence() {
        return view('dashboard.appearence.index');
    }

    public function productDelete($id) {
        $product = Product::find($id);
        $product->delete();

        $productColors = ProductColors::where('product_id', $id)->get();
        foreach ($productColors as $color) {
            $color->delete();
        }
    }


    public function config(){
        return view('dashboard.config.index');
    }
}
