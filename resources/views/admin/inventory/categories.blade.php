@extends('admin.layouts')

@section('content')
<div class="container">
    <h1>Categories</h1>


    <div class="d-flex justify-content-between mb-3">
        
        <button type="button" class="btn btn-success ml-auto"  id="add-category" data-toggle="modal" data-target="#addCategoryModal">
            <i class="fas fa-plus"></i> Create Category
        </button>
        
        <!-- "Go Back" button on the right -->
        {{-- <button type="button" class="btn btn-primary ml-auto" onclick="goBack()">Go Back</button> --}}
    </div>
    

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $count =1 ; ?>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->category_desc }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn text-warning" style="margin-right: -10px"><i class='fa fa-edit'></i></a>

                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                            <button type="submit" class="btn text-danger" onclick="return confirm('Are you sure you want to delete this category?')"><i class='fa fa-trash'></i></button>
                        </form>
                    </td>
                </tr>
                <?php $count++; ?>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for adding category items -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" >
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_description">Category Description</label>
                            <textarea class="form-control" id="category_desc" name="category_desc" rows="3"></textarea>
                            @error('category_desc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Add New Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

@include("admin.sweetalert")
@endsection

@if ($errors->any())
  
<script>
      $(document).ready(function() {
    $('#add-category').click();
});

</script>
@endif
