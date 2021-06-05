<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        //return CategoryResource::collection(Category::all());
        //return Category::all();
        return response()->json(Category::all(), 200);
    }
}
