@extends('admin.layouts')
@section('content')
    <script>
        $(function() {
            $('#transactionsTable').DataTable({
                scrollX: true
            });
        });
    </script>


    <main>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-12 d-flex align-items-center justify-content-between">
                        <div>
                            <h1 class="m-0">Dashboard</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        @role('Admin')
                            <div>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Generate Report</button>
                            </div>
                        @endrole
                    </div>

                </div>
            </div>
        </div>

        <style>
            .corners {
                border-radius: 25px;
            }
        </style>
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets/images/logotouch.png') }}" alt="Saura Dental Clinic">
        </div>

        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <a class="text-decoration-none text-dark" href="{{ route('appointment.pending') }}">
                        <div class="card corners border-left-warning shadow h-100 p-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            pending appointments</div>
                                        <div class="h5 mb-0 font-weight-bold">{{ $pending }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar-alt fa-2x text-secondary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <a class="text-decoration-none text-dark" href="{{ route('appointment.approved') }}">
                        <div class="card corners border-left-primary shadow h-100 p-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            scheduled appointments</div>
                                        <div class="h5 mb-0 font-weight-bold">{{ $scheduled }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar-alt fa-2x text-secondary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                @role('User')
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-decoration-none text-dark" href="{{ route('appointment.canceled') }}">
                            <div class="card corners border-left-danger shadow h-100 p-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                canceled appointments</div>
                                            <div class="h5 mb-0 font-weight-bold">{{ $canceled }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-alt fa-2x text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-decoration-none text-dark" href="{{ route('appointment.completed') }}">
                            <div class="card corners border-left-success shadow h-100 p-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                completed appointments</div>
                                            <div class="h5 mb-0 font-weight-bold">{{ $completed }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-alt fa-2x text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endrole

                @role('Admin')
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-decoration-none text-dark" href="{{ route('admin.services') }}">
                            <div class="card corners border-left-secondary shadow h-100 p-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                Total Services</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $services }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tooth fa-2x text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-decoration-none text-dark" href="{{ route('admin.users') }}">
                            <div class="card corners border-left-info shadow h-100 p-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                No. of Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card corners border-left-secondary shadow h-100 p-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Out of Stock in Equipment
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $outOfStockCount }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-box fa-2x text-secondary"></i> 
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                @endrole

            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container" id="printableArea">
                            <div class="row mb-3">
                                <div class="col">
                                    <div>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="details">
                                <p>
                                    The data provided represents the number of services availed for various dental
                                    procedures. Each label
                                    corresponds to a specific dental service, and the associated numerical data represents
                                    the count of
                                    times each service has been availed.
                                </p>
                                <br>
                                <p>Here is the breakdown of the data:</p>

                                <div id="breakdownlist">
                                    <ol class="list">

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="printCanvas()">Print</button>
                    </div>
                </div>
            </div>
        </div>



    </main>
@endsection

@section('footer-script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        let url = "{{ route('services.getservicesdata') }}";
        let labels = [];
        let data = [];

        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                labels = response.labels;
                data = response.data;
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: '# of service availed',
                            data: data,
                            borderWidth: 1
                        }]
                    },

                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                        },
                    }
                });

                labels.forEach(function(value, key) {
                    var html = '<li><span>' + value + '</span> - <span class=\'fw-bold\'>' + data[key] +
                        ' service availed</span></li>';
                    $('.list').append(html);

                });
            }
        });

        function printDiv(divName) {
            // document.getElementById('hideButtons').style.display = 'none';
            var originalContents = document.body.innerHTML;
            var printContents = document.getElementById(divName).innerHTML;


            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

            // document.getElementById('hideButtons').style.display = '';

        }


        function printCanvas() {
            var dataUrl = document.getElementById('myChart').toDataURL();
            var details = document.getElementById('details').innerHTML;

            let windowContent = '<!DOCTYPE html>';
            windowContent += '<html>';
            windowContent += '<head><title>Print canvas</title></head>';
            windowContent += '<body>';
            windowContent += '<img src="' + dataUrl + '">';
            windowContent += details;
            windowContent += '</body>';
            windowContent += '</html>';

            const printWin = window.open('', '', 'width=' + screen.availWidth + ',height=' + screen.availHeight);
            printWin.document.open();
            printWin.document.write(windowContent);

            printWin.document.addEventListener('load', function() {
                printWin.focus();
                printWin.document.close();
                printWin.print();
            }, true);

            $('#exampleModal').modal('hide');
        }
    </script>
@endsection
