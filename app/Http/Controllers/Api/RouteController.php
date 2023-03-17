<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Response;

class RouteController extends Controller
{
    //get category list
    public function categoryList()
    {
        $data = Category::get();
        return response()->json($data, 200);
    }

    //create category list
    public function createCategory(Request $request)
    {
        $data = $this->getData($request);
        $response = Category::create($data);

        return response()->json($response, 200);
    }

    //create category list
    public function deleteCategory(Request $request)
    {
        $data = Category::where('id', $request->category_id)->first();
        if (isset($data)) {
            Category::where('id', $request->category_id)->delete();
            return response()->json(['message' => 'delete success', 'deleted data' => $data], 200);
        }
        return response()->json(['message' => 'There is no Category'], 200);
    }

    private function getData(Request $request)
    {
        return [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
