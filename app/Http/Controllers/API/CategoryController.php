<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    /**
     * @var App\Services\CategoryService $categoryService
     */
    protected $categoryService;

    public function __construct(CategoryService $catgoryService)
    {
        $this->categoryService = $catgoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $categories = $this->categoryService->getAllCategories();

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
                'name' => 'required|string'
            ]);

            $name = $data['name'];


            $category = $this->categoryService->createCategory($name);

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
    public function show(string $id)
    {
        try{
            $category = $this->categoryService->getCategoryById($id);

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
    public function update(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'name' => 'required|string'
            ]);

            $name = $data['name'];

            $category = $this->categoryService->updateCategory($name, $id);

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
    public function destroy(string $id)
    {
        try{
            $category = $this->categoryService->deleteCategory($id);

            $response['code'] = 200;
            $response['message'] = 'Category deleted successfully';
        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
