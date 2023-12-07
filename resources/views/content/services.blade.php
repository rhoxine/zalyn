@extends('admin.layouts')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-lg-6">
                <h1 class="m-0">Services Content</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Services </li>
                </ol>
            </div>

            <div class="col-6 d-flex align-items-center justify-content-end">
                <button type="button" id="addServicesButton" class="btn btn-outline-success" data-toggle="modal" data-target="#servicesModal">Add Services</button> &nbsp;
                <button type="button" id="addGalleryButton" class="btn btn-outline-success" data-toggle="modal" data-target="#galleryModal">Add Gallery</button>
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
        <div class="modal fade" id="servicesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Content for Services</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('content.services.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label for="services_name">Services Name</label>
                            <input type="text" name="services_name" id="services_name" class="form-control">
                            <label for="price">Price</label>
                            <input type="text" name="price" id="price" class="form-control">
                            <label for="desc">Services Description</label>
                            <input type="text" name="desc" id="desc" class="form-control">
                            <label for="services_image">Services Image</label>
                            <input type="file" name="services_image" id="services_image" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-success">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

  <!-- Add Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="galleryModalLabel">Add Gallery</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="modal-body">
                  <!-- Add your form fields for adding a gallery item -->
                  <!-- Example: -->
                  {{-- <label for="gallery_name">Gallery Name</label>
                  <input type="text" name="gallery_name" id="gallery_name" class="form-control"> --}}
                  <label for="gallery_before">Before</label>
                  <input type="file" name="gallery_before" id="gallery_before" class="form-control">
                  <label for="gallery_after">After</label>
                  <input type="file" name="gallery_after" id="gallery_after" class="form-control">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-outline-success">Save changes</button>
              </div>
          </form>
      </div>
  </div>
</div>

  <div class="row">
      <div class="col-md-8">
          <div class="card mt-3">
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>Service Name</th>
                                  <th>Price</th>
                                  <th>Description</th>
                                  <th>Image</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($services as $service)
                                  <tr>
                                      <td>{{ $service->services_name }}</td>
                                      <td>{{ $service->price }}</td>
                                      <td>{{ $service->desc }}</td>
                                      <td>
                                          @if ($service->services_image)
                                              <img src="{{ asset('storage/' . $service->services_image) }}" alt="{{ $service->services_name }}" class="img-fluid" width="100">
                                          @else
                                              No Image
                                          @endif
                                      </td>
                                      <td>
                                        <div class="d-flex align-items-center">
                                            <a class='toggleEdit text-warning me-2' style='cursor:pointer' data-toggle="modal" data-target="#editServiceModal"
                                                data-service-id="{{ $service->id }}" data-service-name="{{ $service->services_name }}"
                                                data-service-desc="{{ $service->desc }}" data-service-price="{{ $service->price }}">
                                                <i class='fa fa-edit'></i>
                                            </a>
                                            <form action="{{ route('services_destroy', $service->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                              @csrf
                                              @method('DELETE')
                                              
                                              <button type="submit" class="toggleDelete text-danger border-0">
                                                  <i class="fa fa-trash"></i>
                                              </button>
                                          </form>
                                          
                                        </div>
                                    </td>
                                    
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-md-4">
        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image Before</th>
                                <th>Image After</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gallery as $galleries)
                                <tr>
                                    <td>
                                        @if ($galleries->gallery_before)
                                            <img src="{{ asset('storage/' . $galleries->gallery_before) }}" alt="{{ $galleries->gallery_before }}" class="img-fluid" width="100">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        @if ($galleries->gallery_after)
                                            <img src="{{ asset('storage/' . $galleries->gallery_after) }}" alt="{{ $galleries->gallery_after }}" class="img-fluid" width="100">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                      <div class="d-flex align-items-center">
                                      <button type="button" style="margin-right: -9px" class="btn btn-link text-warning " data-toggle="modal" data-target="#editGalleryModal" data-gallery-id="{{ $galleries->id }}" data-gallery-before="{{ $galleries->gallery_before }}" data-gallery-after="{{ $galleries->gallery_after }}">
                                          <i class="fas fa-edit"></i>
                                      </button>
                                    
                                      <form action="{{ route('gallery.destroy', $galleries->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-link text-danger">
                                              <i class="fas fa-trash"></i>
                                          </button>
                                      </form>
                                      </div>
                                  </td>
                                  
                                  
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
  </div>


    <!-- Modal for Edit -->
<div class="modal fade" id="editServiceModal" tabindex="-1" role="dialog" aria-labelledby="editServiceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editServiceModalLabel">Edit Content for Services</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('contents.updateServices', ['id' => '__service_id__']) }}" method="POST" enctype="multipart/form-data" id="editServiceForm">
              @csrf
              @method('PUT') <!-- Use PUT method for updating -->
              <div class="modal-body">
                  <input type="hidden" name="service_id" id="edit_service_id">
                  <label for="edit_services_name">Services Name</label>
                  <input type="text" name="services_name" id="edit_services_name" class="form-control">
                  <label for="edit_price">Price</label>
                  <input type="text" name="price" id="edit_price" class="form-control">
                  <label for="edit_desc">Description</label>
                  <input type="text" name="desc" id="edit_desc" class="form-control">
                  <label for="edit_services_image">Services Image</label>
                  <input type="file" name="services_image" id="edit_services_image" class="form-control">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-outline-success">Save changes</button>
              </div>
          </form>
      </div>
  </div>
</div>
{{-- edit gallery modal --}}
<div class="modal fade" id="editGalleryModal" tabindex="-1" role="dialog" aria-labelledby="editGalleryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editGalleryModalLabel">Edit Gallery</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            @foreach($gallery as $galleries)
            <form id="editGalleryForm" action="{{ route('gallery.update', $galleries->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
        
                <div class="form-group">
                    <label for="gallery_before">Gallery Before (Image):</label>
                    <input type="file" class="form-control" id="gallery_before" name="gallery_before" accept="image/jpeg, image/png, image/jpg, image/gif">
                    @error('gallery_before')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="gallery_after">Gallery After (Image):</label>
                    <input type="file" class="form-control" id="gallery_after" name="gallery_after" accept="image/jpeg, image/png, image/jpg, image/gif">
                    @error('gallery_after')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
        
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
            @endforeach
        </div>
     
      </div>
  </div>
</div>

<script>
  $(document).ready(function () {
      $('#servicesModal').modal({
          backdrop: 'static',
          keyboard: false
      });

      // Handle edit button click
      $('.toggleEdit').click(function () {
          var serviceId = $(this).data('service-id');
          var serviceName = $(this).data('service-name');
          var serviceDesc = $(this).data('service-desc');
          var servicePrice = $(this).data('service-price');

          // Set values in the edit modal
          $('#edit_service_id').val(serviceId);
          $('#edit_services_name').val(serviceName);
          $('#edit_desc').val(serviceDesc);
          $('#edit_price').val(servicePrice);

          // Update the form action with the correct service ID
          var formAction = "{{ route('contents.updateServices', ['id' => 'service_id']) }}".replace('service_id', serviceId);

          // Replace the placeholder with the actual service ID
          $('#editServiceForm').attr('action', formAction);

          // Show the edit modal
          $('#editServiceModal').modal({
              backdrop: true,
              keyboard: true
          });
      });
  });
</script>


@endsection