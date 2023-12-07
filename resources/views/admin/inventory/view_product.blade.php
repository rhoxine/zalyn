@extends('admin.layouts')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">View Product</h1>
                    <button type="button" class="btn btn-success" onclick="goBack()">Go Back</button>
                </div>
                <h2>Product Details</h2>
                <div class="row">
                    <div class="col-md-6">
                        
                        <table class="table">
                            <tr >
                                <th style="background-color:rgb(99, 170, 192)">Product Name:</th>
                                <td>{{ $product->prod_name }}</td>
                            </tr>
                            <tr>
                                <th style="background-color:rgb(99, 170, 192)">Serial Number:</th>
                                <td>{{ $product->serial_num }}</td>
                            </tr>
                            <tr>
                                <th style="background-color:rgb(99, 170, 192)">Manufacturer:</th>
                                <td>{{ $product->manufacturer }}</td>
                            </tr>
                            <tr>
                                <th style="background-color:rgb(99, 170, 192)">Price:</th>
                                <td><i class="fa fa-peso-sign"></i>{{ $product->price }}</td>
                            </tr>
                            
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <th style="background-color:rgb(99, 170, 192)">Purchased Date:</th>
                                <td>{{ $product->purchased_date }}</td>
                            </tr>
                            <tr>
                                <th style="background-color:rgb(99, 170, 192)">Quantity:</th>
                                <td>{{ $product->qty }}</td>
                            </tr>
                            <tr>
                                <th style="background-color:rgb(99, 170, 192)">Category:</th>
                                <td>{{ $product->category->category_name }}</td>
                            </tr>
                            <tr>
                                <th style="background-color:rgb(99, 170, 192)">Notes:</th>
                                <td>{{ $product->note }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
