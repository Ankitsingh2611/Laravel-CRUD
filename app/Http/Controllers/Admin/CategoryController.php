<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view ("admin.category.index", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ("admin.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:30|unique:categories',
            'image' => 'required'
        ]);

        try{
            $category = new Category;
            $category->name = $validated['name'];
            $category->slug = Str::slug($validated['name']);

            $file = $request->file("image");
            $filename = time().".".$file->getClientOriginalExtension();
            $file->move("uploads/categories/", $filename);
            $category->image = $filename;

            $category->save();

            return redirect('admin/categories')->with("success", "Category created");
        }
        catch(Exception $error){
            return redirect('admin/categories')->with("error", "Category cannot be created");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo "Show called";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        $data = compact("category");
        return view ("admin.category.edit")->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:30|unique:categories',
            'slug' => 'required',
        ]);

        try{
            $category = Category::find($id);
            if($category){
                $category->name = $validated['name'];
                $category->slug = Str::slug($validated['slug']);
    
                if($request->hasFile("image")){
                    $destination = "uploads/categories/".$category->image;
                    if(File::exists($destination)){
                        File::delete($destination);
                    }

                    $file = $request->file("image");
                    $filename = time().".".$file->getClientOriginalExtension();
                    $file->move("uploads/categories/", $filename);
                    $category->image = $filename;
                }
    
                $category->update();
    
                return redirect('admin/categories')->with("success", "Category updated");
            }
            else{
                return redirect('admin/categories')->with("error", "Category cannot be found");
            }
        }
        catch(Exception $error){
            return redirect('admin/categories')->with("error", "Category cannot be updated");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        echo "Destroy called: Item deleted : ".$id;
    }

    public function delete(string $id)
    {
        try{
            $category = Category::find($id);
            if($category){
                $destination = "uploads/categories/".$category->image;
                if(File::exists($destination)){
                    File::delete($destination);
                }
    
                $category->delete();
    
                return redirect('admin/categories')->with("success", "Category deleted");
            }
            else{
                return redirect('admin/categories')->with("error", "Category cannot be found");
            }
        }
        catch(Exception $error){
            return redirect('admin/categories')->with("error", "Category cannot be deleted");
        }
    }
}
