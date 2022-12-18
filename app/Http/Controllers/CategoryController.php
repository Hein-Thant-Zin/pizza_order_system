<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    //direct category list page
    public function list()

    {
        // dd(request('key'));
        $categories = Category::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })->orderBy('category_id', 'desc')->paginate(5);
        //   {{-- {{ for remaining the searching value after changing the paginate }} --}}
        $categories->appends(request()->all());

        // dd($categories);
        return view('admin.category.list', compact('categories'));
    }

    //direct category create page
    public function createPage()
    {
        return view('admin.category.create');
    }

    //

    //create category
    public function create(Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess' => 'Category Created..']);
    }

    //delete category
    public function delete($id)
    {
        Category::where('category_id', $id)->delete();
        // return redirect()->route('category#list'); they are the same
        return back()->with(['deleteSuccess' => 'Category Deleted..']);
    }
    //category validation check
    private function categoryValidationCheck($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name'
        ])->validate();
    }

    //request category data
    private function requestCategoryData($request)
    {
        return [
            'name' => $request->categoryName
        ];
    }
}