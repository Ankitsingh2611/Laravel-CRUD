@extends('layouts.admin.master')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1>Create Category</h1>
        <a href="{{url('/admin/categories')}}" class="btn btn-primary"><i class="fas fa-edit"></i> View Categories</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Category Name">
                    <label for="name">Category Name</label>
                    @error('name')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="image">Cover Image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection