<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * @var App\Models\Category; $category
     */
    protected $category;

    public function __construct(Category $catgory)
    {
        $this->category = $catgory;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $categories = $this->category->all();

            $response['code'] = 200;
            $response['data'] = CategoryResource::collection($categories);
        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $data = $request->validate([
                'name' => 'required|string|unique:categories,name'
            ]);

            $name = strtolower(str_replace(' ', '', $data['name']));
            
            $category = $this->category->create([
                'name' => $name
            ]);

            $response['code'] = 201;
            $response['data'] = new CategoryResource($category);
        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try{
            $response['code'] = 200;
            $response['data'] = new CategoryResource($category);
        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try{
            $data = $request->validate([
                'name' => 'required|string|unique:categories,name'
            ]);

            $name = strtolower(str_replace(' ', '', $data['name']));

            $category->update([
                'name' => $name
            ]);

            $response['code'] = 200;
            $response['data'] = new CategoryResource($category);
        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        try{
            $category->delete();

            $response['code'] = 200;
            $response['message'] = 'Category deleted successfully';
        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
