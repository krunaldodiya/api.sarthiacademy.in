<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories(Request $request)
    {
        $categories = Category::with('chapters.topics.videos')
            ->orderBy('order')
            ->get();

        return response(['categories' => $categories], 200);
    }
}
