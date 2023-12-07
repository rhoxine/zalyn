@extends('admin.layouts')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
        <button type="button" class="btn btn-success" onclick="goBack()">Go Back</button>
    </div>
    <form method="POST" action="{{ route('categories.update', ['category' => $category->id]) }}">
        @csrf
        @method('PUT')
   
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input  class="form-control" type="text" name="category_name" id="category_name" value="{{ $category->category_name }}" required>
        </div>
        <div class="form-group">
            <label for="category_description">Category Description</label>
            <textarea class="form-control" id="category_desc" name="category_desc" rows="3">{{ $category->category_desc }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update Category</button>
    </form> 
</div>    
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
