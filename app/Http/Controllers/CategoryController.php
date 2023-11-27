<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::getAvailableCategorys();
        return response()->json($categorys);
    }

    public function countCategories()
    {
        $count = Category::count();
        return response()->json($count);
    }


    public function addMainCategories(Request $request)
    {

        MainCategory::truncate();

        foreach ($request->categories as $categoryData) {
            unset($categoryData['id']);
            MainCategory::create($categoryData);
        }


        return response()->json(['message' => 'Categorias principais adicionadas com sucesso!']);
    }

    public function getMainCategories()
    {
        $mainCategories = MainCategory::all();
        return response()->json($mainCategories);
    }

    public function showCategories() {
        $categories = Category::all();
        return view('dashboard.categories.index', ['categories' => $categories]);
    }

    public function createCategory() {
        return view('dashboard.categories.create');
    }

    public function categoryStore(CategoryRequest $request)
    {
        $category = new Category();

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->images = 'teste';
        $category->status = $request->input('status');

        $category->save();

        $this->uploadImage($request, $category);
    }

    public function editCategory($id) 
    {
        $category = Category::find($id);

        return view('dashboard.categories.edit', compact('category'));
    }

    public function categoryUpdate( CategoryUpdateRequest $request, $id) 
    {
        $category = Category::find($id);  
        $category->name = $request->input('name'); 
        $category->description = $request->input('description');
        $category->status = $request->input('status');

        if ($request->hasFile('images')) {
            $this->uploadImage($request, $category);
        }
        $category->save();
        
    }

    public function categoryDelete($id) 
    {
        $category = Category::find($id);
        $category->delete();
    }

    public function uploadImage(Request $request, $category)
    {
        $rootDirectory = 'images/categories';

        $categoryId = $category->id;
        $categoryDirectory = "{$rootDirectory}/$categoryId";

        if (!Storage::disk('public')->exists($categoryDirectory)) {
            Storage::disk('public')->makeDirectory($categoryDirectory);
        }
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            $path = $image->storeAs($categoryDirectory, $imageName, 'public');
            $category->images = $imageName;

        }
        $category->save();
    }
}
