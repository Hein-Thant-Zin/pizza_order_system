<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function list()

    {
        // dd(request('key'));
        $order = Order::paginate(4);
        $categories = Category::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })->orderBy('id', 'desc')->paginate(5);
        //   {{-- {{ for remaining the searching value after changing the paginate }} --}}
        $categories->appends(request()->all());

        // dd($categories);
        return view('admin.category.list', compact('categories', 'order'));
    }

    //direct category create page
    public function createPage()
    {
        return view('admin.category.create');
    }


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
        // dd($id);
        Category::where('id', $id)->delete();
        // return redirect()->route('category#list'); they are the same
        return back()->with(['deleteSuccess' => 'Category Deleted..']);
    }

    //edit category page
    public function edit($id)
    {
        $category = Category::where('id', $id)->first(); //just assign 'category' to use in client side and can name whatever
        return view('admin.category.edit', compact('category')); //just assign 'category' to use in client side and can name whatever
    }

    //update page
    public function update(Request $request)

    {
        // dd($request->all());
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id', $request->categoryId)->update($data);
        return redirect()->route('category#list');
    }

    //category validation check
    private function categoryValidationCheck($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|min:3|unique:categories,name,' . $request->categoryId
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
