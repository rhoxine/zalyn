@extends('admin.layouts')
@section('content')
    <main>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-6">
                        <h1 class="m-0">Services</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Services</li>
                        </ol>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-end">
                        <button id="toggleAdd" class="btn btn-success btn-sm">Add New Service</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card p-3 shadow" style="overflow-x:auto;">
                        <table id='servicesTable' class='display responsive table w-100' cellspacing="0">
                            <thead>
                                <th>ID</th>
                                <th>Service</th>
                                <th>Price</th>
                                <th width="50px">Action</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" action="{{ route('services.store') }}" method="post">
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col">
                                    @csrf
                                    <div class="row mb-2 form-group">
                                        <div class="col">
                                            <label class="form-label">Service</label>
                                            <input id="add_service_input" type="text" class="form-control"
                                                name="service">
                                            <span class="text-danger" id="add_service_error"></span>
                                        </div>

                                    </div>
                                    <div class="row mb-2 form-group">
                                        <div class="col">
                                            <label class="form-label">Price</label>
                                            <input id="add_price_input" type="number" class="form-control" name="price">
                                            <span class="text-danger" id="add_price_error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btnAdd">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="editForm" action="" method="post">
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col">
                                    @csrf
                                    <input type="hidden" id="edit_id_input" name="id">
                                    <div class="row mb-2 form-group">
                                        <div class="col">
                                            <label class="form-label">Service</label>
                                            <input id="edit_service_input" type="text" class="form-control"
                                                name="service">
                                            <span class="text-danger" id="edit_service_error"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-2 form-group">
                                        <div class="col">
                                            <label class="form-label">Price</label>
                                            <input id="edit_price_input" type="text" class="form-control"
                                                name="price">
                                            <span class="text-danger" id="edit_price_error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="btnSave">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure? Do you want to delete this record.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="btnDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let tableName = $('#servicesTable').DataTable({
            'columnDefs': [{
                'orderable': false, // set orderable false for selected columns
            }],
            responsive: true
        });

        function tableReload() {

            tableName.clear();

            const url = "{{ route('services.getallservices') }}";

            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: url,
                data: "",
                dataType: "JSON",
                success: function(data) {
                    if (data.data.length === 0 || typeof data.data === "undefined" || typeof data
                        .data === null) {
                        tableName.draw();
                    } else {

                        $.map(data.data, function(record) {

                            const tr = $(
                                "<tr>" +
                                "<td>" + record.id + "</td>" +
                                "<td>" + record.service_name + "</td>" +
                                "<td> ₱ " + parseInt(record.price).toFixed(2) + "</td>" +
                                "<td>" +
                                "<a class='toggleEdit text-warning me-2' style='cursor:pointer' data-id='" +
                                record.id + "'>" +
                                "<i class='fa fa-edit'></i>" +
                                "</a>" +
                                "<a class='toggleDelete text-danger' style='cursor:pointer' data-id='" +
                                record.id + "'>" +
                                "<i class='fa fa-trash'></i>" +
                                "</a>" +
                                "</td>" +
                                "</tr>"
                            );

                            tableName.row.add(tr[0]).draw();
                        });

                    }
                },
            });
        }

        $(document).ready(function() {

            tableReload();

            $(document).on('click', '#toggleAdd', function() {
                $('#addModal').modal('show');
            });

            $('#btnAdd').on('click', function(ev) {
                ev.preventDefault();
                $('#btnAdd').prop('disabled', true);
                $('#btnAdd').html("<i class='fa fa-spinner fa-spin'></i> Loading");

                $('#add_service_error').html("");
                $('#add_price_error').html("");

                let addForm = $("#addForm")[0];
                let addFormData = new FormData(addForm);

                const url = "{{ route('services.store') }}";

                $.ajax({
                    type: "post",
                    url: url,
                    data: addFormData,
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(res) {
                        console.log(res);
                        $('#btnAdd').prop('disabled', false);
                        $('#btnAdd').html("Add");
                        if (res.status === 400) {
                            if (res.error.service != null) {
                                $('#add_service_error').html(res.error.service);
                            }
                            if (res.error.price != null) {
                                $('#add_price_error').html(res.error.price);
                            }
                        }

                        if (res.status === 200) {
                            $('#add_service_error').html("");
                            $('#add_price_error').html("");

                            $('#add_service_input').val('');
                            $('#add_price_input').val('');
                            new swal({
                                title: 'Success',
                                text: 'Inserted Successfully',
                                icon: 'success',
                            });
                            $('#addModal').modal('hide');
                            tableReload();
                        }
                    },
                    error: function(res) {
                        console.log(res);
                        $('#btnAdd').prop('disabled', false);
                        $('#btnAdd').html("Add");
                    }
                });
            });


            $(document).on('click', '.toggleEdit', function() {
                var id = $(this).data('id');

                var url = "{{ route('services.edit', ':id') }}";
                url = url.replace(':id', id);


                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        $("#editForm").attr('action', url);
                        $('#edit_id_input').val(data.data.id);
                        $('#edit_service_input').val(data.data.service_name);
                        $('#edit_price_input').val(data.data.price);

                        $('#editModal').modal('show');
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

            $('#btnSave').on('click', function(ev) {
                ev.preventDefault();
                $('#btnSave').prop('disabled', true);
                $('#btnSave').html("<i class='fa fa-spinner fa-spin'></i> Loading");

                $('#edit_service_error').html("");
                $('#edit_price_error').html("");

                let editForm = $("#editForm")[0];
                let editFormData = new FormData(editForm);

                let id = editFormData.get('id');

                var url = "{{ route('services.update', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    type: "post",
                    url: url,
                    data: editFormData,
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(res) {
                        console.log(res);
                        $('#btnSave').prop('disabled', false);
                        $('#btnSave').html("Save");

                        if (res.status === 400) {
                            if (res.error.service != null) {
                                $('#edit_service_error').html(res.error.service);
                            }
                            if (res.error.price != null) {
                                $('#edit_price_error').html(res.error.price);
                            }
                        }

                        if (res.status === 200) {
                            new swal({
                                title: 'Success',
                                text: 'Record Updated Successfully!',
                                icon: 'success',
                            });

                            $('#editModal').modal('hide');
                            tableReload();
                        }
                    },
                    error: function(res) {
                        new swal({
                            title: 'Success',
                            text: 'Failed to update the record. Please try again.',
                            icon: 'success',
                        });
                    }
                }).done(function(data) {
                    $('#btnSave').prop('disabled', false);
                    $('#btnSave').html("Save");
                });
            });


            $(document).on('click', '.toggleDelete', function() {
                var id = $(this).data('id');

                var url = "{{ route('services.select', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        $('#btnDelete').val(id);

                        $('#deleteModal').modal('show');
                    },
                    error: function(data) {
                        new swal({
                            title: 'Error',
                            text: 'Something went wrong',
                            icon: 'error'
                        });
                    }
                });

            });

            $('#btnDelete').on('click', function(ev) {

                var url = "{{ route('services.delete', ':id') }}";
                url = url.replace(':id', $('#btnDelete').val());


                $.ajax({
                    type: "DELETE",
                    contentType: "application/json; charset=utf-8",
                    url: url,
                    data: "",
                    dataType: "JSON",
                    success: function(data) {
                        new swal({
                            title: 'Success!',
                            text: 'Record Deleted Successfully!',
                            icon: 'success'
                        });

                        tableReload();
                    },
                    error: function(response) {
                        new swal({
                            title: 'Error',
                            text: 'Something went wrong',
                            icon: 'error'
                        });
                    }
                });

                $('#deleteModal').modal('hide');

                $('#btnDelete').val();
            });
        });
    </script>
@endsection

@push('footer-script')
@endpush
