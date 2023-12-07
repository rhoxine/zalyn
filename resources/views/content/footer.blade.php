@extends('admin.layouts')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-lg-6">
                <h1 class="m-0">Footer and About</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Footer and About</li>
                </ol>
            </div>
            
            <div class="col-6 d-flex align-items-center justify-content-end">
                <button type="button" id="addServicesButton" class="btn btn-outline-success" data-toggle="modal" data-target="#footersModal" {{ $footer->count() > 0 ? 'disabled' : '' }}>Add footers</button>
            </div>
        </div>
    </div>
</div>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <!-- Modal -->
 
<div class="modal fade" id="footersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Content for footers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('content.footer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" class="form-control" name="logo" id="logo">
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" class="form-control" name="facebook">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="copyright">Copyright</label>
                        <input type="text" class="form-control" name="copyright">
                    </div>
                    <div class="form-group">
                        <label for="days">Days Open</label>
                        <input type="text" class="form-control" name="days">
                    </div>
                    <div class="form-group">
                        <label for="hours">Hours Open</label>
                        <input type="text" class="form-control" name="hours">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Facebook</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Copyright</th>
                        <th>Days Open</th>
                        <th>Hours Open</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($footer as $footers)
                        <tr>
                            <td>
                                @if ($footers->logo)
                                    <img src="{{ asset('storage/' . $footers->logo) }}" alt="{{ $footers->logo }}" class="img-fluid" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $footers->facebook }}</td>
                            <td>{{ $footers->address }}</td>
                            <td>{{ $footers->phone }}</td>
                            <td>{{ $footers->copyright }}</td>
                            <td>{{ $footers->days }}</td>
                            <td>{{ $footers->hours }}</td>
                            <td>
                                <button type="button" class="btn btn-link text-warning" data-toggle="modal" data-target="#editFootersModal" >
                                    <i class="fas fa-edit"></i>
                                </button>
                                {{-- <button class="btn btn-outline-success" data-toggle="modal" data-target="#editFootersModal">Edit</button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="editFootersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Content for Footers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @if (isset($footers))
                <form action="{{ route('content.footer.update', ['id' => $footers->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <label for="editLogo">Logo</label>
                        <input type="file" name="logo" id="editLogo" class="form-control">
                        <label for="facebook">Facebook</label>
                        <input type="text" name="facebook" value="{{ $footers->facebook }}" class="form-control">
                        <label for="address">Address</label>
                        <input type="text" name="address" value="{{ $footers->address }}" class="form-control">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" value="{{ $footers->phone }}" class="form-control" id="phone">
                        <label for="copyright">Copyright</label>
                        <input type="text" name="copyright" value="{{ $footers->copyright }}" class="form-control">
                        <label for="days">Days Open</label>
                        <input type="text" name="days" value="{{ $footers->days }}" class="form-control">
                        <label for="hours">Hours Open</label>
                        <input type="text" name="hours" value="{{ $footers->hours }}" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">Update</button>
                    </div>
                </form>
            @else
                <div class="modal-body">
                    No data available for editing.
                </div>
            @endif
        </div>
    </div>
</div>

  <script>
  $(document).ready(function () {
   
    $('#footersModal').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#editFootersModal').on('show.bs.modal', function (event) {
            // Re-enable the "Add footers" button when the edit modal is shown
            $('#addServicesButton').prop('disabled', false);
        });
});

  </script>
@endsection