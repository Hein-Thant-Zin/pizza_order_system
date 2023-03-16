<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $order = Order::paginate(4);
        $orderForDate = Order::latest()->first();
        $pizzas = Product::select('products.*', 'categories.name as category_name')
            ->when(request('key'), function ($query) {
                $query->where('products.name', 'like', '%' . request('key') . '%');
            })
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('products.created_at', 'desc')
            ->paginate(4);
        return view('admin.product.pizzaList', compact('pizzas', 'order', 'orderForDate'));
    }

    //direct product create page
    public function createPage()
    {
        $order = Order::paginate(4);
        $orderForDate = Order::latest()->first();
        $categories = Category::select('id', 'name')->get();
        // dd($categories->toArray());
        return view('admin.product.create', compact('categories', 'order', 'orderForDate'));
    }

    //create product
    public function create(Request $request)
    {
        $order = Order::paginate(4);
        $orderForDate = Order::latest()->first();
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

    //direct product details page
    public function details($id)
    {
        // dd($id);
        $pizza = Product::where('id', $id)->first();
        // dd($pizzas->toArray());
        return view('admin.product.details', compact('pizza'));
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
        // dd($data);
        if ($request->hasFile('pizzaImage')) {
            # code...
            $oldImageName = Product::where('id', $request->pizzaId)->first();
            $oldImageName = $oldImageName->image;
            // dd($oldImageName);
            if ($oldImageName != null) {
                Storage::delete('public/' . $oldImageName);
            }
            $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        Product::where('id', $request->pizzaId)->update($data);
        return redirect()->route('products#list')->with(['createSuccess' => "createSuccess"]);
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
            // 'id' => $request->pizzaId,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,
            // 'image' => $request->pizzaImage
        ];
    }
}