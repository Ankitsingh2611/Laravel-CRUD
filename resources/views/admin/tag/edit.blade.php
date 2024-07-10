@extends('layouts.admin.master')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1>Edit Tag</h1>
        <a href="{{url('/admin/tags')}}" class="btn btn-primary"><i class="fas fa-edit"></i> View Tags</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="{{route('admin.tags.update', $tag->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Tag Name" value="{{$tag->name}}">
                    <label for="name">Tag Name</label>
                    @error('name')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="slug" class="form-control" placeholder="Slug" value="{{$tag->slug}}">
                    <label for="slug">Slug</label>
                    @error('slug')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

