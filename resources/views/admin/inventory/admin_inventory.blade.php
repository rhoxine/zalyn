
@extends('admin.layouts')

@section('content')

{{-- add product modal --}}
<div class="modal fade" id="addproductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="{{ route('products.store') }}" id="addProductForm">
                @csrf

                <div class="modal-body">
                    <!-- First Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="category_id">Category:</label>
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="" disabled selected>Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="name">Product Name:</label>
                            <input type="text" class="form-control" name="prod_name">
                            @error('prod_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Second Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="status">Serial Number:</label>
                            <input type="text" class="form-control" name="serial_num" id="serial_num">
                            @error('serial_num')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="manufacturer">Manufacturer:</label>
                            <input type="text" class="form-control" name="manufacturer" id="manufacturer">
                            @error('manufacturer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-body">
                    <!-- Third Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" name="price" id="price">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="purchased_date">Purchased Date:</label>
                            <input type="date" class="form-control" name="purchased_date">
                            @error('purchased_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Fourth Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" name="qty" id="qty">
                            @error('qty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="notes">Notes:</label>
                            <input type="text" class="form-control" name="note" id="note">
                            @error('note')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="submitForm()">Add product</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Inventory Management</h1>
            <div>

                <button class="btn btn-success mr-2" id="btn-add" data-toggle="modal" data-target="#addproductModal">Add product</button>
                <button class="btn btn-primary btn-warning mr-2">
                    <a href="{{ route('admin.categories.index') }}" style="color: white;">Add Category</a>
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table id="inventoryTable" class="display">
            <thead>
                <tr>
                    
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Serial Number</th>

                    <th>Price</th>
                    <th>Purchased Date</th>
                    <th>Quantity</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td style="width: 150px">{{ $product->category->category_name }}</td>
                        <td>{{ $product->prod_name }}</td>
                        <td>{{ $product->serial_num }}</td>

                        <td>{{ $product->price }}</td>

                        <td>{{ $product->purchased_date }}</td>

                        <td>
                            <div class="input-group quantity-control">
                                <button class="btn btn-sm btn-secondary quantity-button"
                                    onclick="decrementQuantity({{ $product->id }})">-</button>
                                <input type="text" class="form-control" style="width: 40px; font-size: 12px" 
                                    id="quantity_{{ $product->id }}" value="{{ $product->qty }}">
                                {{-- <button class="btn btn-sm btn-secondary quantity-button"
                                    onclick="incrementQuantity({{ $product->id }})">+</button> --}}
                            </div>
                        </td>
                        <td>

                            <a href="{{ route('products.view', ['product' => $product->id]) }}" style="color: white;"
                                class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('products.edit', ['product' => $product->id]) }}" style="color: white;"
                                class="btn btn-sm btn-warning"><i class='fa fa-edit'></i></a>

                            <form id="deleteForm_{{ $product->id }}" method="POST"
                                action="{{ route('products.destroy', ['products' => $product->id]) }}"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger mx-0"
                                    onclick="confirmDelete({{ $product->id }})"><i class='fa fa-trash'></i></button>
                            </form>
                        </td>

                    </tr>
                    <script>
                        function confirmDelete(id) {
                            if (confirm('Are you sure you want to delete this product?')) {
                                // If confirmed, submit the form to delete the product
                                document.getElementById('deleteForm_' + id).submit();
                            }
                        }
                    </script>
                @endforeach
            </tbody>
        </table>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    @if ($errors->any())
  
    <script>
          $(document).ready(function() {
        $('#btn-add').click();
    });
    </script>
  
    @endif
    <script>
        $(document).ready(function() {

            $('#inventoryTable').DataTable({
                searching: true, // Enable searching
                columns: [
                    {
                        searchable: false
                    },// Category
                    {
                        searchable: true
                    }, // Product Name
                    {
                        searchable: false
                    }, // Serial Number
                    {
                        searchable: false
                    }, // Price
                    {
                        searchable: true
                    }, // Purchased Date
                    {
                        searchable: false
                    }, // Quantity
                    null // Actions
                ]
            });

            // Add an event listener for changes in the "Product Name" search field
            $('#searchProdName').on('input', function() {
                $('#inventoryTable').DataTable().column(1).search(this.value).draw();
            });

            // Add an event listener for changes in the "Purchased Date" search field
            $('#searchPurchasedDate').on('input', function() {
                $('#inventoryTable').DataTable().column(4).search(this.value).draw();
            });
        });

        // Function to populate the update product modal with data
        function editproduct(id, name, quantity) {
            $('#product_id').val(id);
            $('#update_name').val(name);
            $('#update_quantity').val(quantity);
            $('#updateproductModal').modal('show');
        }


        // function incrementQuantity(id) {
        //     let quantityInput = document.getElementById('quantity_' + id);
        //     let currentQuantity = parseInt(quantityInput.value);
        //     quantityInput.value = currentQuantity + 1;
        //     updateQuantity(id, currentQuantity + 1);
        // }

        function decrementQuantity(id) {
            let quantityInput = document.getElementById('quantity_' + id);
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 0) {
                quantityInput.value = currentQuantity - 1;
                updateQuantity(id, currentQuantity - 1);
            }
            
        } 

        function updateQuantity(id, newQuantity) {
            $.ajax({
                method: 'POST',
                url: '{{ route('admin.products.updQuantity') }}',
                data: {
                    product_id: id,
                    quantity: newQuantity,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Handle success response if needed
                },
                error: function(error) {
                    // Handle errors or display an error message
                },
            });
        }
        function submitForm() {
        // Submit the form using JavaScript
        $('#addProductForm').submit();
    }
  
    </script>
@endsection
