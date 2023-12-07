@extends('admin.layouts')

@section('content')
    <main>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-6">
                        <h1 class="m-0">Review</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Review</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @role('User')
            
<div class="container-fluid">
    <div class="row">
        <!-- Leave Feedback Section -->
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="row">
                    <div class="col-lg-6 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('assets/images/review.jpg') }}" alt="Feedback" style="width: 70%;">
                    </div>
                    <div class="col-lg-6">
                        <div class="p-4">
                            <h1 class="mb-4">Leave Feedback</h1>
                            <p>We become even more dedicated to our work when we receive your valuable feedback.</p>
                            @if ($reviews->where('user_id', auth()->user()->id)->isEmpty())
                                <form action="{{ route('review.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="comment">Your Comment:</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit Review</button>
                                    </div>
                                </form>
                            @else
                                <div class="form-group">
                                    <p>Thank you for sending feedback!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Reviews Section -->
        <div class="col-lg-4">
            <div class="card shadow w-100">
                <div class="card-header bg-secondary">
                    My Reviews
                </div>
                {{-- <h4 class="p-3">My Reviews</h4> --}}
                @if (isset($reviews))
                    @foreach ($reviews->where('user_id', auth()->user()->id) as $review)
                    <div class="row m-2">
                        <div class="col-md-8">
                            <strong><p>Comment</p></strong>
                        </div>
                        <div class="col-md-4">
                            <strong><p>Action</p></strong>
                        </div>
                        
                    </div>
                  
                        <div class="row m-2">
                            <div class="col-md-8">
                                <p>{{ $review->comment }}</p>
                            </div>
                            <div class="col-md-4">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-link text-warning" data-toggle="modal"
                                        data-target="#editReviewModal{{ $review->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('review.destroy', $review) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal for Editing a Review -->
                        <div class="modal" id="editReviewModal{{ $review->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('review.update', $review) }}" method="POST"
                                        id="updateReviewForm">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Review</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="update_comment">Your Review:</label>
                                                <textarea class="form-control" name="update_comment" rows="3">{{ $review->comment }}</textarea>
                                            </div>
                                            {{-- <div class="update_rating" data-review-id="{{ $review->id }}">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star" data-rating="{{ $i }}" style="color: {{ $i <= $review->rating ? '#f90' : '#ddd' }}"></i>
                                    @endfor
                                    <input type="hidden" name="update_rating" id="selectedRating_{{ $review->id }}" value="{{ $review->rating }}">
                                </div> --}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div></div>
          
        @endrole


        @role('Admin')
            @if (isset($reviews))
                <table id="reviews-table" class="display">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Comment</th>
                            <th>Date Created</th>
                            {{-- <th>Add Website</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <td>{{ $review->user->name }}</td>
                                <td>{{ $review->comment }}</td>
                                <td>{{ $review->created_at->format('F j, Y') }}</td>
                                {{-- <td>
                                    <button class="post-button" data-review-id="{{ $review->id }}">Post</button>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endrole
        <script>
            $(document).ready(function() {
                $('#reviews-table').DataTable();

                // Setting up CSRF token for AJAX requests
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.post-button').on('click', function() {
                    var reviewId = $(this).data('review-id');

                    // Make an Ajax request to update the review
                    $.ajax({
                        type: 'PUT', // Use PUT for update
                        url: '/admin/review/update/' + reviewId, // Update the URL to the correct route
                        data: {
                            update_comment: $('#edit_comment')
                        .val(), // Get the updated comment from the textarea
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            // Handle success, e.g., display a message or update the UI
                            console.log('Review updated successfully');
                        },
                        error: function(error) {
                            // Handle error, e.g., display an error message
                            console.error('Error updating review:', error);
                        }
                    });
                });

            });
            document.addEventListener('DOMContentLoaded', function() {
                // Get all star icons
                const stars = document.querySelectorAll('.rating i');

                // Add click event listener to each star
                // stars.forEach(star => {
                //     star.addEventListener('click', function () {
                //         const rating = this.getAttribute('data-rating');

                //         // Update the hidden input value
                //         document.getElementById('selectedRating').value = rating;

                //         // Reset color for all stars
                //         stars.forEach(s => s.style.color = '#000');

                //         // Change color for selected stars
                //         for (let i = 0; i < rating; i++) {
                //             stars[i].style.color = '#f90';
                //         }
                //     });
                // });

                // Set the initial color for existing rating when the page loads
                // const currentRating = document.getElementById('selectedRating').value;
                // for (let i = 0; i < currentRating; i++) {
                //     stars[i].style.color = '#f90';
                // }
            });
        </script>


    @endsection

    @push('footer-script')
        <!-- Your footer scripts -->
    @endpush
