<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    //create product
    public function create(Request $request)
    {
        // dd($request->all());
        $this->productValidationCheck($request, 'create');
        $data = $this->requestProductInfo($request);

        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        // dd($data);
        Product::create($data);
        return redirect()->route('products#list');
    }


    //edit product
    public function edit($id)
    {
        $pizza = Product::where('id', $id)->first();
        $categories = Category::get();
        return view('admin.product.edit', compact('pizza', 'categories'));
    }

    //update product
    public function updateProduct(Request $request)
    {
        $this->productValidationCheck($request, 'update');
        $data = $this->requestProductInfo($request);
        if ($request->hasFile('pizzaImage')) {
            $oldImageName = Product::where('id', $request->pizzaId)->first();
            $oldImageName = $oldImageName->image;
            if ($oldImageName != null) {
                Storage::delete('public/' . $oldImageName);
            }
            $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        Product::where('id', $request->pizzaId)->update($data);


        return redirect()->route('products#list');
    }

    //delete
    public function deleteProduct($id)
    {
        // dd($id);

        Product::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Deleted successfully']);
    }



    //product validation Check
    private function productValidationCheck($request, $action)
    {
        $validationRules = [
            'pizzaName' => 'required|min:3|unique:products,name,' . $request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime' => 'required'

        ];
        $validationRules['pizzaImage'] = $action == "create" ? 'required|mimes:jpg,png,jpeg,webp|file' : 'mimes:jpg,png,jpeg,webp|file';

        Validator::make($request->all(), $validationRules)->validate();
    }
    private function requestProductInfo($request)
    {
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'id' => $request->id,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,
            'image' => $request->pizzaImage
        ];
    }
}