@extends('admin.layouts')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-lg-6">
                <h1 class="m-0">Filter Appointments</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Filter Appointments</li>
                </ol>
            </div>
            {{-- <div class="col-6 d-flex align-items-center justify-content-end">
                <button id="toggleAdd" class="btn btn-success btn-sm">Add New Appointment</button>
            </div> --}}
        </div>
    </div>
</div>
    <div class="container">
        <div class="card">
            <div class="card-body">
        
        <form action="{{ route('appointments.filter') }}" method="post" id="filterForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>
            </div>
        </div>
            <button type="button" class="btn btn-success" onclick="submitFilterForm()">Filter Appointments</button>
        </form>
    </div>

    <div class="container-fluid mt-4">
       

                <table id="productTable">
                    <thead>
                        <tr>
                            <th>Appointment ID</th>
                            <th>Patient</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Status</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @isset($filteredAppointments)
                            @foreach ($filteredAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->id }}</td>
                                    <td>{{ $appointment->user->name }}</td>
                                    <td>
                                     
                                        {{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y') }}
                                    </td>
                                    <td>
                                            @if ($appointment->status == 0)
                                            <span class="ml-3"><i class="fa fa-minus" style="color: gray"></i></span>
                                        @elseif ($appointment->status == 1)
                                        <span class="ml-3"><i class="fa fa-minus" style="color: gray"></i></span>
                                        @elseif ($appointment->status == 2)
                                            <span class="ml-3"><i class="fa fa-minus" style="color: gray"></i></span>
                                        @elseif ($appointment->status == 3)
                                        ₱ {{ optional($appointment->service)->price }}
                                            
                                        @else
                                            <span class="badge badge-secondary">Unknown</span>
                                        @endif
                                </td>
                             
                                    <td>
                                        @if ($appointment->status == 0)
                                            <span class='px-3 py-1 bg-warning rounded-pill'>Pending</span>
                                        @elseif ($appointment->status == 1)
                                            <span class='px-3 py-1 bg-primary rounded-pill'>Approved</span>
                                        @elseif ($appointment->status == 2)
                                            <span class='px-3 py-1 bg-danger rounded-pill'>Canceled</span>
                                        @elseif ($appointment->status == 3)
                                            <span class='px-3 py-1 bg-success rounded-pill'>Completed</span>
                                            <br>
                                            
                                        @else
                                            <span class="badge badge-secondary">Unknown</span>
                                        @endif
                                    </td>
                                 
                                </tr>
                               
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-right mr-5">
        @if (isset($totalPrice))
           <strong> Total Amount:</strong> ₱{{ number_format($totalPrice, 2) }}
        @else
            No total amount found.
        @endif
    </div>
    <script>
        function submitFilterForm() {
            document.getElementById('filterForm').submit();
        }
        
    </script>
    
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
                        title: ' Appointments Report',
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
