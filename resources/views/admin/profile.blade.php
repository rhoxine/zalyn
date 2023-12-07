@extends('admin.layouts')
@section('content')
    <main>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-6">
                        <h1 class="m-0">Profile</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow">
                        <div class="card-header bg-secondary">
                            Personal Details
                        </div>
                        <form id="detailsForm" action="{{ route('profile.update') }}" method="POST">
                            <div class="container p-2 px-3">
                                <div class="row">
                                    <div class="col">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <div class="row mb-2 form-group">
                                            <div class="col">
                                                <label class="form-label" for="name_input">Name</label>
                                                <input id="name_input" type="text" class="form-control" name="name">
                                                <span class="text-danger" id="name_error"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2 form-group">
                                            <div class="col">
                                                <label class="form-label" for="email_input">Email</label>
                                                <input id="email_input" type="email" class="form-control" name="email">
                                                <span class="text-danger" id="email_error"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2 form-group">
                                            <div class="col">
                                                <label class="form-label" for="bdate_input">Birth Date</label>
                                                <input id="bdate_input" type="date" class="form-control" name="bdate"
                                                    max="2013-12-31">
                                                <span class="text-danger" id="bdate_error"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2 form-group">
                                            <div class="col">
                                                <label class="form-label" for="phonenum_input">Phone Number</label>
                                                <input id="phonenum_input" type="tel" class="form-control"
                                                    name="phonenum">
                                                <span class="text-danger" id="phonenum_error"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2 form-group">
                                            <div class="col">
                                                <label class="form-label" for="phonenum_input">Sex</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sex"
                                                        id="sex_male_input" value="male">
                                                    <label class="form-check-label" for="sex_male_input">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sex"
                                                        id="sex_female_input" value="female">
                                                    <label class="form-check-label" for="sex_female_input">
                                                        Female
                                                    </label>
                                                </div>
                                                <span class="text-danger" id="sex_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row my-2">
                                    <div class="col text-end">
                                        <button id="btnUpdate" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header  bg-secondary">
                            Change Password
                        </div>
                        <form id="changepassForm" action="{{ route('profile.changepass') }}" method="POST">
                            <div class="container p-2 px-3">
                                <div class="row">
                                    <div class="col">
                                        @csrf
                                        <div class="row mb-2 form-group">
                                            <div class="col">
                                                <label class="form-label" for="oldpassword_input">Old Password</label>
                                                <input id="oldpassword_input" type="password" class="form-control"
                                                    name="oldpassword">
                                                <span class="text-danger" id="oldpassword_error"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2 form-group">
                                            <div class="col">
                                                <label class="form-label">New Password</label>
                                                <input id="newpassword_input" type="password" class="form-control"
                                                    name="newpassword">
                                                <span class="text-danger" id="newpassword_error"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2 form-group">
                                            <div class="col">
                                                <label class="form-label">Confirm Password</label>
                                                <input id="confirmpassword_input" type="password" class="form-control"
                                                    name="confirmpassword">
                                                <span class="text-danger" id="confirmpassword_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col text-end">
                                        <button id="btnChangePass" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            @role('User')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header bg-secondary">
                            Medical History
                        </div>
                        <div class="container p-2">
                            <div class="row">
                                <div class="col">
                                    <form id="medhistoryForm" action="{{ route('profile.savemedhistory') }}"
                                        method="POST">
                                        <table id="medhistory_table" class="table">
                                            <thead>
                                                <th style="width: 50%"></th>
                                                <th style="width: 10%">Yes</th>
                                                <th style="width: 30%">Notes/Description</th>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col text-end">
                                    <button id="btnSave" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endrole
        </div>

    </main>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function reload() {
            const url = "{{ route('profile.getuser') }}";

            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: url,
                data: "",
                dataType: "JSON",
                success: function(data) {
                    if (data.status === 200) {
                        $('#name_input').val(data.data.name);
                        $('#email_input').val(data.data.email);
                        $('#bdate_input').val(data.data.bdate);
                        $('#phonenum_input').val(data.data.phonenum);
                        if (data.data.sex == 0) {
                            $('#sex_male_input').prop('checked', true);
                            $('#sex_female_input').prop('checked', false);
                        } else {    
                            $('#sex_female_input').prop('checked', true);
                            $('#sex_male_input').prop('checked', false);
                        }
                    }
                },
            });
        }

        function fetchMedHistory() {
            const url = "{{ route('profile.getmedhistory') }}";

            $('#medhistory_table tbody').empty();

            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: url,
                data: "",
                dataType: "JSON",
                success: function(data) {
                    if (data.data.length !== 0 || typeof data.data !== "undefined" || typeof data
                        .data !== null) {
                        $.map(data.data, function(record) {
                            let notes = "";
                            let tr = "";
                            if (record.notes != null) {
                                notes = record.notes;
                            }

                            if (record.yes == 1) {
                                tr = $(
                                    "<tr>" +
                                    "<td> " + record.question + " </td>" +
                                    "<td><input checked type='checkbox' name='yes[" + record.id +
                                    "]'></td>" +
                                    "<td>" +
                                    "<textarea name='notes[" + record.id +
                                    "]' id='' cols='30' rows='3' class='form-control'>" +
                                    notes +
                                    "</textarea>" +
                                    "</td>" +
                                    "</tr>"
                                );
                            } else {
                                tr = $(
                                    "<tr>" +
                                    "<td> " + record.question + " </td>" +
                                    "<td><input class='form-check-input' type='checkbox' name='yes[" +
                                    record.id +
                                    "]'></td>" +
                                    "<td>" +
                                    "<textarea class='form-control' name='notes[" + record.id +
                                    "]' id='' cols='30' rows='3' class='form-control'>" +
                                    notes +
                                    "</textarea>" +
                                    "</td>" +
                                    "</tr>"
                                );
                            }

                            $('#medhistory_table tbody').append(tr[0]);
                        });
                    }
                },
            });
        }


        $(document).ready(function() {

            reload();
            fetchMedHistory();
            $(document).on('click', '#btnChangePass', function(ev) {
                ev.preventDefault();
                $('#btnChangePass').prop('disabled', true);
                $('#btnChangePass').html("<i class='fa fa-spinner fa-spin'></i> Loading");

                $('#oldpassword_error').html("");
                $('#newpassword_error').html("");
                $('#confirmpassword_error').html("");

                let changepassForm = $("#changepassForm")[0];
                let changepassFormData = new FormData(changepassForm);

                const url = "{{ route('profile.changepass') }}";

                $.ajax({
                    type: "post",
                    url: url,
                    data: changepassFormData,
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(res) {
                        $('#btnChangePass').prop('disabled', false);
                        $('#btnChangePass').html("Add");
                        if (res.status === 400) {
                            if (res.error.oldpassword != null) {
                                $('#oldpassword_error').html(res.error.oldpassword);
                            }
                            if (res.error.newpassword != null) {
                                $('#newpassword_error').html(res.error.newpassword);
                            }
                            if (res.error.confirmpassword != null) {
                                $('#confirmpassword_error').html(res.error.confirmpassword);
                            }
                        }

                        if (res.status === 200) {
                            $('#oldpassword_error').html("");
                            $('#newpassword_error').html("");
                            $('#confirmpassword_error').html("");

                            $('#oldpassword_input').val('');
                            $('#newpassword_input').val('');
                            $('#confirmpassword_input').val('');

                            new swal({
                                title: 'Success',
                                text: 'Updated Successfully',
                                icon: 'success',
                            });
                        }
                    },
                    error: function(res) {
                        new swal({
                            title: 'Error',
                            text: 'Failed to update the record. Please try again.',
                            icon: 'error',
                        });
                        $('#btnChangePass').prop('disabled', false);
                        $('#btnChangePass').html("Add");
                    }
                });
            });

            $(document).on('click', '#btnUpdate', function(ev) {
                ev.preventDefault();
                $('#btnUpdate').prop('disabled', true);
                $('#btnUpdate').html("<i class='fa fa-spinner fa-spin'></i> Loading");

                $('#name_error').html("");
                $('#email_error').html("");
                $('#bdate_error').html("");
                $('#phonenum_error').html("");
                $('#sex_error').html("");


                let detailsForm = $("#detailsForm")[0];
                let detailsFormData = new FormData(detailsForm);

                const url = "{{ route('profile.update') }}";

                $.ajax({
                    type: "post",
                    url: url,
                    data: detailsFormData,
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(res) {
                        $('#btnUpdate').prop('disabled', false);
                        $('#btnUpdate').html("Save");
                        if (res.status === 400) {
                            if (res.error.name != null) {
                                $('#name_error').html(res.error.name);
                            }
                            if (res.error.email != null) {
                                $('#email_error').html(res.error.email);
                            }
                            if (res.error.phonenum != null) {
                                $('#phonenum_error').html(res.error.phonenum);
                            }
                            if (res.error.bdate != null) {
                                $('#bdate_error').html(res.error.bdate);
                            }
                            if (res.error.sex != null) {
                                $('#sex_error').html(res.error.sex);
                            }
                        }

                        if (res.status === 200) {
                            reload();

                            new swal({
                                title: 'Success',
                                text: 'Updated Successfully',
                                icon: 'success',
                            });
                        }
                    },
                    error: function(res) {
                        new swal({
                            title: 'Error',
                            text: 'Failed to update the record. Please try again.',
                            icon: 'error',
                        });
                        $('#btnUpdate').prop('disabled', false);
                        $('#btnUpdate').html("Save");
                    }
                });
            });

            $(document).on('click', '#btnSave', function(ev) {
                ev.preventDefault();
                $('#btnSave').prop('disabled', true);
                $('#btnSave').html("<i class='fa fa-spinner fa-spin'></i> Loading");

                let medhistoryForm = $("#medhistoryForm")[0];
                let medhistoryFormData = new FormData(medhistoryForm);
                const url = "{{ route('profile.savemedhistory') }}";

                $.ajax({
                    type: "post",
                    url: url,
                    data: medhistoryFormData,
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(res) {
                        $('#btnSave').prop('disabled', false);
                        $('#btnSave').html("Save");

                        if (res.status === 200) {
                            fetchMedHistory();

                            new swal({
                                title: 'Success',
                                text: 'Updated Successfully',
                                icon: 'success',
                            });
                        }

                        console.log(res);
                    },
                    error: function(res) {
                        new swal({
                            title: 'Error',
                            text: 'Failed to update the record. Please try again.',
                            icon: 'error',
                        });
                        $('#btnSave').prop('disabled', false);
                        $('#btnSave').html("Save");
                    }
                });

            });

        });
    </script>
@endsection

@push('footer-script')
@endpush
