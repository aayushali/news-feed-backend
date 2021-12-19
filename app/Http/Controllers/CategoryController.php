<?php

namespace App\Http\Controllers;
use App\Models\CategoryModel;
use App\Models\TagModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return CategoryModel::all();
    }

    // create category
    public function store_category(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required',
            'category_type' => 'required',
        ]);
        if ($validatedData) {
            $category_name = $request->category_name;
            $category_type = $request->category_type;
            $category = new CategoryModel;
            $category->category_name = $category_name;
            $category->category_type =$category_type;
            $category->save();
        }
        $results = [
            "data" => $category,
            "code" => 200,
            "message" => "New tag inserted successfully"
        ];
        return response()->json($results);
    }

    // update category
    public function updateCategory(Request $request, $id)
    {
        if ($id) {
            $categoryName = $request->category_name;
            $categoryType = $request->category_type;
            $category = CategoryModel::findOrFail($id);
            $category->category_name = $categoryName;
            $category->category_type = $categoryType;
            $category->save();
            $results = [
                "data" => $category,
                "code" => 200,
                "message" => "Category updated successfully"
            ];
            return response()->json($results);
        }

    }

    public function destroy($id)
    {
        if ($id) {
            $category = CategoryModel::findOrFail($id);
            $category->delete();
            $category = CategoryModel::all();
            return response()->json($category);

        }
    }
}
