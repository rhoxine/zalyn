@extends('admin.layouts')
@section('content')
    <main>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-6">
                        <h1 class="m-0">Scheduled Appointments</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Scheduled Appointments</li>
                        </ol>
                    </div>
                    {{-- <div class="col-6 d-flex align-items-center justify-content-end">
                        <button id="toggleAdd" class="btn btn-success btn-sm">Add New Appointment</button>
                    </div> --}}
                </div>
            </div>
        </div>

        @role('User')
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card p-3 shadow" style="overflow-x:auto;">
                            <table id='userPendingTable' class='display responsive table w-100' cellspacing="0">
                                <thead>
                                    <th width="30%">Appointment ID</th>
                                    <th width="50%">Date</th>
                                    <th width="20%">Status</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endrole

        @role('Admin')
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card p-3 shadow" style="overflow-x:auto;">
                            <table id='adminPendingTable' class='display responsive table w-100' cellspacing="0">
                                <thead>
                                    <th width="20%">Appointment ID</th>
                                    <th width="25%">Date</th>
                                    <th width="25%">Name</th>
                                    <th width="20%">Status</th>
                                    <th width="10%">Action</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endrole

    </main>

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Complete Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="approveForm" action="" method="post">
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col">
                                    @csrf
                                    <input type="hidden" id="approve_id_input" name="id">
                                    <div class="row mb-2 form-group">
                                        <div class="col">
                                            <label class="form-label">Availed Service</label>
                                            <select class="form-select" name="services" id="services"></select>
                                        </div>
                                    </div>
                                    <div class="row mb-2 form-group">
                                        <div class="col">
                                            <label class="form-label">Prescriptions</label>
                                            <textarea class="form-control" id="prescription" name="prescription" cols="30" rows="3"></textarea>
                                            <span class="text-danger" id="prescription_error"></span>
                                        </div>
                                    </div>
                                    You're about to complete the appointment <strong><span id="app_id"></span></strong>.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success" id="btnApprove">Complete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancel Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="cancelForm" action="" method="post">
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col">
                                    @csrf
                                    <input type="hidden" id="cancel_id_input" name="id">
                                    <div class="row mb-2 form-group">
                                        <div class="col">
                                            <label class="form-label">Reason</label>
                                            <textarea class="form-control" id="reason" name="reason" cols="30" rows="3"></textarea>
                                            <span class="text-danger" id="reason_error"></span>
                                        </div>

                                    </div>
                                    You're about to cancel the appointment <strong><span
                                            id="cancel_app_id"></span></strong>.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-danger" id="btnCancel">Cancel Appointment</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let userPendingTable = $('#userPendingTable').DataTable({
            'columnDefs': [{
                'orderable': false, // set orderable false for selected columns
            }],
            responsive: true
        });

        let adminPendingTable = $('#adminPendingTable').DataTable({
            'columnDefs': [{
                'orderable': false, // set orderable false for selected columns
            }],
            responsive: true
        });

        function pad(n) {
            var string = "" + n;
            var pad = "0000";
            n = pad.substring(0, pad.length - string.length) + string;
            return "APP-" + n;
        }

        function userTableReload() {

            userPendingTable.clear();

            const url = "{{ route('appointment.getallapproved') }}";

            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: url,
                data: "",
                dataType: "JSON",
                success: function(data) {
                    if (data.data.length === 0 || typeof data.data === "undefined" || typeof data
                        .data === null) {
                        userPendingTable.draw();
                    } else {

                        $.map(data.data, function(record) {

                            let status =
                                "<span class='px-3 py-1 bg-warning rounded-pill'>Pending</span>";
                            switch (record.status) {
                                case 1:
                                    status =
                                        "<span class='px-3 py-1 bg-primary rounded-pill'>Approved</span>";
                                    break;
                                case 2:
                                    status =
                                        "<span class='px-3 py-1 bg-danger rounded-pill'>Canceled</span>";
                                    break;
                                case 3:
                                    status =
                                        "<span class='px-3 py-1 bg-success rounded-pill'>Completed</span>";
                                    break;
                            }

                            var options = {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            };
                            let date = new Date(record.date);
                            date = date.toLocaleDateString("en-US", options);

                            let id = pad(record.id);

                            const tr = $(
                                "<tr>" +
                                "<td>" + id + "</td>" +
                                "<td>" + date + "</td>" +
                                "<td>" + status + "</td>" +
                                "</tr>"
                            );

                            userPendingTable.row.add(tr[0]).draw();
                        });

                    }
                },
            });
        }

        function adminTableReload() {

            adminPendingTable.clear();

            const url = "{{ route('appointment.getallapproved') }}";

            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: url,
                data: "",
                dataType: "JSON",
                success: function(data) {
                    if (data.data.length === 0 || typeof data.data === "undefined" || typeof data
                        .data === null) {
                        adminPendingTable.draw();
                    } else {

                        $.map(data.data, function(record) {

                            let status =
                                "<span class='px-3 py-1 bg-warning rounded-pill'>Pending</span>";
                            switch (record.status) {
                                case 1:
                                    status =
                                        "<span class='px-3 py-1 bg-primary rounded-pill'>Approved</span>";
                                    break;
                                case 2:
                                    status =
                                        "<span class='px-3 py-1 bg-danger rounded-pill'>Canceled</span>";
                                    break;
                                case 3:
                                    status =
                                        "<span class='px-3 py-1 bg-success rounded-pill'>Completed</span>";
                                    break;
                            }

                            var options = {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            };
                            let date = new Date(record.date);
                            date = date.toLocaleDateString("en-US", options);

                            let id = pad(record.id);

                            const tr = $(
                                "<tr>" +
                                "<td>" + id + "</td>" +
                                "<td>" + date + "</td>" +
                                "<td>" + record.user.name + "</td>" +
                                "<td>" + status + "</td>" +
                                "<td>" +
                                "<a class='toggleApprove text-success me-2' style='cursor:pointer' data-id='" +
                                record.id + "'>" +
                                "<i class='fa fa-check'></i>" +
                                "</a>" +
                                "<a class='toggleCancel text-danger me-2' style='cursor:pointer' data-id='" +
                                record.id + "'>" +
                                "<i class='fa fa-ban'></i>" +
                                "</a>" +
                                "</td>" +
                                "</tr>"
                            );

                            adminPendingTable.row.add(tr[0]).draw();
                        });

                    }
                },
            });
        }

        $(document).ready(function() {

            userTableReload();
            adminTableReload();


            $(document).on('click', '.toggleApprove', function() {
                var id = $(this).data('id');

                var url = "{{ route('appointment.select', ':id') }}";
                url = url.replace(':id', id);

                $('#services').empty();
                $('#prescription').val('');



                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        let id = pad(data.data[0].id);
                        $("#approveForm").attr('action', url);
                        $('#approve_id_input').val(data.data[0].id);
                        $('#app_id').html(id);

                        data.services.forEach(element => {
                            $('#services').append(
                                    "<option value='" + element
                                    .id + "'>" + element.service_name + "</option>")
                        });

                        $('#approveModal').modal('show');
                    },
                    error: function(data) {
                        console.log(data);
                        new swal({
                            title: 'Error',
                            text: 'Something went wrong',
                            icon: 'error'
                        });
                    }
                });

            });

            $('#btnApprove').on('click', function(ev) {
                ev.preventDefault();
                $('#btnApprove').prop('disabled', true);
                $('#btnApprove').html("<i class='fa fa-spinner fa-spin'></i> Loading");

                let approveForm = $("#approveForm")[0];
                let approveFormData = new FormData(approveForm);

                let id = approveFormData.get('id');

                var url = "{{ route('appointment.complete', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    type: "post",
                    url: url,
                    data: approveFormData,
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(res) {
                        console.log(res);
                        $('#btnApprove').prop('disabled', false);
                        $('#btnApprove').html("Compelete");

                        if (res.status === 200) {
                            new swal({
                                title: 'Success',
                                text: 'Record Updated Successfully!',
                                icon: 'success',
                            });
                            userTableReload();
                            adminTableReload();
                            $('#approveModal').modal('hide');

                        }
                    },
                    error: function(res) {
                        new swal({
                            title: 'Success',
                            text: 'Failed to approve the record. Please try again.',
                            icon: 'success',
                        });
                    }
                }).done(function(data) {
                    $('#btnApprove').prop('disabled', false);
                    $('#btnApprove').html("Complete");
                });
            });

            $(document).on('click', '.toggleCancel', function() {
                var id = $(this).data('id');

                var url = "{{ route('appointment.select', ':id') }}";
                url = url.replace(':id', id);

                $('#reason').val('');

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        let id = pad(data.data[0].id);
                        console.log(id);

                        $("#cancelForm").attr('action', url);
                        $('#cancel_id_input').val(data.data[0].id);
                        $('#cancel_app_id').html(id);
                        $('#cancelModal').modal('show');
                    },
                    error: function(data) {
                        console.log(data);
                        new swal({
                            title: 'Error',
                            text: 'Something went wrong',
                            icon: 'error'
                        });
                    }
                });

            });

            $('#btnCancel').on('click', function(ev) {
                ev.preventDefault();
                $('#btnCancel').prop('disabled', true);
                $('#btnCancel').html("<i class='fa fa-spinner fa-spin'></i> Loading");

                // $('#cancel_reason_error').html("");

                let cancelForm = $("#cancelForm")[0];
                let cancelFormData = new FormData(cancelForm);

                let id = cancelFormData.get('id');

                var url = "{{ route('appointment.cancel', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    type: "post",
                    url: url,
                    data: cancelFormData,
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(res) {
                        console.log(res);
                        $('#btnCancel').prop('disabled', false);
                        $('#btnCancel').html("Cancel Appointment");

                        // if (res.status === 400) {
                        //     if (res.error.reason != null) {
                        //         $('#edit_reason_error').html(res.error.reason);
                        //     }
                        // }

                        if (res.status === 200) {
                            new swal({
                                title: 'Success',
                                text: 'Record Updated Successfully!',
                                icon: 'success',
                            });

                            userTableReload();
                            adminTableReload();
                            $('#cancelModal').modal('hide');
                        }
                    },
                    error: function(res) {
                        new swal({
                            title: 'Success',
                            text: 'Failed to cancel the record. Please try again.',
                            icon: 'success',
                        });
                    }
                }).done(function(data) {
                    $('#btnCancel').prop('disabled', false);
                    $('#btnCancel').html("Cancel Appointment");
                });
            });


        });
    </script>
@endsection

@push('footer-script')
@endpush
