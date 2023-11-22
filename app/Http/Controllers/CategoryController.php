<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
}
