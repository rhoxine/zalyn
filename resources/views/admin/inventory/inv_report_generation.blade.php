@extends('admin.layouts')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-lg-6">
                <h1 class="m-0">Filtered Products</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Inventory</li>
                </ol>
            </div>
            {{-- <div class="col-6 d-flex align-items-center justify-content-end">
                <button id="toggleAdd" class="btn btn-success btn-sm">Add New Appointment</button>
            </div> --}}
        </div>
    </div>
</div>
           <div class="card">
            <div class="card-body">
                
             
                <!-- Display filter form -->
                <form method="GET" action="{{ route('admin.inv_report_generation') }}" class="mb-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Start Date:</label>
                                <input type="date" class="form-control" name="start_date" id="start_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">End Date:</label>
                                <input type="date" class="form-control" name="end_date" id="end_date">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success"> Filter Inventory</button>
                        </div>
                    </div>
                </form>
        
                <table id="productTable">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>Serial Number</th>
                            <th>Manufacturer</th>
                            <th>Price</th>
                            <th>Purchased Date</th>
                            <th>Quantity</th>
                            <th>Notes</th>
                         
                        </tr>
                    </thead>
                    
                    <tbody>
                        @if(request()->has('start_date') && request()->has('end_date'))
                        @foreach ($filteredProducts as $product)
                            <tr>
                                <td>{{ $product->category->category_name }}</td>
                                <td>{{ $product->prod_name }}</td>
                                <td>{{ $product->serial_num }}</td>
                                <td>{{ $product->manufacturer }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->purchased_date }}</td>
                                <td>{{ $product->qty }}</td>
                                <td>{{ $product->note }}</td>
                               
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
           </div>
       
   
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>

<style>
   
    /* .dt-buttons {
        margin-bottom: 10px; 
    } */

    .btn-datatable {
        color: #161616;
        background-color: rgba(255, 255, 255, 0.973);
        border-color:  rgba(15, 151, 83, 0.849);
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-datatable:hover {
        background-color: rgba(15, 151, 83, 0.849);
        border-color: rgba(15, 151, 83, 0.849);
    }
</style>
<script>
    $(document).ready(function() {
        $('#productTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                    {
                        extend: 'copyHtml5',
                        className: 'btn-datatable'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn-datatable'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Inventory Report',
                        customize: function(doc) {
                            
                        },
                        className: 'btn-datatable'
                    },
                    {
                        extend: 'csvHtml5',
                        className: 'btn-datatable'
                    },
                    {
                        extend: 'print',
                        className: 'btn-datatable'
                    }
                ]
        });
    });
</script>

@endsection
