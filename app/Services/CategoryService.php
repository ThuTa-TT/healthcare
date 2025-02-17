<?php 

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * @var App\Models\Category $category
     */
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category; 
    }

    /**
     * Get all categories
     */ 
    public function getAllCategories()
    {
        try{
            $categories = $this->category->all();
            return $categories;
        }catch(\Exception $e){      
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Create a category
     */
    public function createCategory($name)
    {
        try{
            $data = [
                'name' => $name
            ];

            $category = $this->category->create($data);

            return $category;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Get a category by id
     */
    public function getCategoryById($id)
    {
        try{
            $category = $this->category->find($id);
            return $category;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Update a category
     */
    public function updateCategory($id, $name)
    {
        try{
            $category = $this->category->find($id);
            $category->name = $name;
            $category->save();

            return $category;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Delete a category
     */
    public function deleteCategory($id)
    {
        try{
            $category = $this->category->find($id);
            $category->delete();

            return $category;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    
}