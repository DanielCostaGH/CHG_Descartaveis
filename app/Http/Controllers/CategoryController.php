<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MainCategory;
use Illuminate\Http\Request;

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
}
