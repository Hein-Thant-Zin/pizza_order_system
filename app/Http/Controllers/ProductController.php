<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct product list page
    public function list()
    {
        $pizzas = Product::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.product.pizzaList', compact('pizzas'));
    }

    //direct product create page
    public function createPage()
    {
        $categories = Category::select('id', 'name')->get();
        // dd($categories->toArray());
        return view('admin.product.create', compact('categories'));
    }

    //edit product
    public function edit($productId)
    {
        $pizza = Product::where('product_id', $productId)->first();
        return view('admin.product.edit', compact('pizza'));
    }

    //update product
    public function updateProduct(Request $request)
    {
        // dd($request->productId);
        // dd($request->all());
        $this->productValidationCheck($request);
        $data = $this->requestProductInfo($request);
        // dd($data);
        Product::where('product_id', $request->productId)->update($data);
        return redirect()->route('products#list');
    }

    //delete
    public function deleteProduct($productId)
    {
        // dd($productId);

        Product::where('product_id', $productId)->delete();
        return back()->with(['deleteSuccess' => 'Deleted successfully']);
    }


    //create product
    public function create(Request $request)
    {
        // dd($request->all());
        $this->productValidationCheck($request);
        $data = $this->requestProductInfo($request);

        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        // dd($data);
        Product::create($data);
        return redirect()->route('products#list');
    }

    //product validation Check
    private function productValidationCheck($request)
    {
        Validator::make($request->all(), [
            'pizzaName' => 'required|min:3|unique:products,name',
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice' => 'required',
            'pizzaImage' => 'required|mimes:jpg,png,jpeg,webp|file',
            'pizzaWaitingTime' => 'required'

        ])->validate();
    }
    private function requestProductInfo($request)
    {
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'product_id' => $request->productId,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,
            'image' => $request->pizzaImage
        ];
    }
}