@extends('admin.layouts')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Equipment</h1>
            <button type="button" class="btn btn-success" onclick="goBack()">Go Back</button>
        </div>
        <form method="POST" action="{{ route('products.update', ['product' => $product->id]) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="update_category">Category:</label>
                        <select class="form-control" name="update_category" id="update_category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="update_status">Serial Number:</label>
                        <input type="text" class="form-control" name="update_serial_num" id="update_serial_num"
                            value="{{ $product->serial_num }}" style="width: 100%">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="update_name">Product Name:</label>
                        <input type="text" class="form-control" name="update_prod_name" id="update_prod_name"
                            value="{{ $product->prod_name }}" style="width: 100%">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="update_status">Manufacturer:</label>
                        <input type="text" class="form-control" name="update_manufacturer" id="update_manufacturer"
                            value="{{ $product->manufacturer }}" style="width: 100%">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="update_date">Purchased Date</label>
                        <input type="date" class="form-control" name="update_date" id="update_date"
                            value="{{ $product->purchased_date }}" style="width: 100%">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="update_quantity">Quantity:</label>
                        <input type="number" class="form-control" name="update_qty" id="update_qty"
                            value="{{ $product->qty }}" style="width: 100%">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="update_notes">Notes:</label>
                        <textarea class="form-control" name="update_notes" id="update_notes" cols="30" rows="3" style="width: 100%">{{ $product->note }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="update_status">Price:</label>
                        <input type="text" class="form-control" name="update_price" id="update_price"
                            value="₱{{ $product->price }}" style="width: 100%">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Update product</button>
        </form>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
