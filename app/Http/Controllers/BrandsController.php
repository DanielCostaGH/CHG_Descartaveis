<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandsController extends Controller
{

    public function getBrands()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }


    public function store(Request $request)
    {

        foreach ($request->brands as $brandData) {
            $brand = new Brand();
            $brand->name = $brandData['name'];

            if (isset($brandData['images']) && $brandData['images']) {
                $imageName = $this->uploadImage($brandData['images']);
                $brand->images = $imageName;
            }

            $brand->save();
        }
    }

    private function uploadImage($image)
    {
        $rootDirectory = 'images/brands';
        if (!Storage::exists($rootDirectory)) {
            Storage::makeDirectory($rootDirectory, 0777, true);
        }

        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs($rootDirectory, $imageName, 'public');

        return $imageName;
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        $imagePath = 'images/brands/' . $brand->images;

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $brand->delete();

        return response()->json(['message' => 'Marca excluída com sucesso']);
    }
}
