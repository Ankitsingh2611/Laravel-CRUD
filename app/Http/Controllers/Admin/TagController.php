<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Tag;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::all();
        return view ("admin.tag.index", compact("tags"));
    }

    public function create(){
        return view ("admin.tag.create");
    }

    public function store(Request $request){
        $validated = $request->validate([
            "name" => "required",
        ]);

        try{
            $tag = new Tag;
            $tag->name = $validated["name"];
            $tag->slug = Str::slug($validated["name"]);
            $tag->save();
            return redirect('admin/tags')->with("success", "Tag created");
        }
        catch(Exception $error){
            return redirect('admin/tags')->with("error", "Tag cannot be created");
        }
    }

    public function edit($id){
        $tag = Tag::find($id);
        if($tag){
            return view ("admin.tag.edit", compact("tag"));
        }
        else{
            return redirect('admin/tags')->with("error", "Tag cannot be found");
        }
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            "name" => "required",
            "slug" => "required",
        ]);

        try{
            $tag = Tag::find($id);
            if($tag){
                $tag->name = $validated["name"];
                $tag->slug = Str::slug($validated["slug"]);
                $tag->update();
                return redirect('admin/tags')->with("success", "Tag updated");
            }
            else{
                return redirect('admin/tags')->with("error", "Tag cannot be found");
            }
        }
        catch(Exception $error){
            return redirect('admin/tags')->with("error", "Tag cannot be updated");
        }

    }

    public function destroy($id){
        try{
            $tag = Tag::find($id);
            if($tag){
                $tag->delete();
                return redirect('admin/tags')->with("success", "Tag deleted");
            }
            else{
                return redirect('admin/tags')->with("error", "Tag cannot be found");
            }
        }
        catch(Exception $error){
            return redirect('admin/tags')->with("error", "Tag cannot be deleted");
        }
    }
}
