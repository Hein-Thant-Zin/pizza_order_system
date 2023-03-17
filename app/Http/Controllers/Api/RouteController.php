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
    public function deleteCategory($id)
    {
        $data = Category::where('id', $id)->first();
        if (isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json(['message' => 'delete success', 'deleted data' => $data], 200);
        }
        return response()->json(['message' => 'There is no Category'], 200);
    }

    //create category list
    public function update(Request $request)
    {
        $categoryId = $request->category_id;
        $dbSource = Category::where('id', $categoryId)->first();
        if (isset($dbSource)) {
            $data = $this->getCategoryData($request);
            Category::where('id', $categoryId)->update($data);
            return response()->json(['message' => 'Category updated'], 200);
        }
        return response()->json(['message' => 'There is no Category'], 200);
        // return $data;
    }

    //get category details
    public function details($id)
    {
        $data = Category::where('id', $id)->first();
        if (isset($data)) {
            // Category::where('id',  $request->category_id)->delete();
            return response()->json(['status' => true,  'message' => 'details view success', 'Category' => $data], 200);
        }
        return response()->json(['status' => false, 'category' => 'There is no Category'], 200);
        // return $request->all();
        // $data = Category::get();
        // return response()->json($data, 200);
    }

    private function getData(Request $request)
    {
        return [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
    private function getCategoryData($request)
    {
        return [
            'name' => $request->category_name,
            // 'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
