@extends('layouts.admin.master')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1>Edit Category</h1>
        <a href="{{url('/admin/categories')}}" class="btn btn-primary"><i class="fas fa-edit"></i> View Categories</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="{{route("categories.update", $category->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Category Name" value="{{$category->name}}">
                    <label for="name">Category Name</label>
                    @error('name')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="slug" class="form-control" placeholder="Slug" value="{{$category->slug}}">
                    <label for="slug">Slug</label>
                    @error('slug')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="image">Cover Image</label>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset("uploads/categories/".$category->image)}}" alt="" class="img-fluid">
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection