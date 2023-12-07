@extends('admin.layouts')

@section('content')
@role('Admin')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-lg-6">
                <h1 class="m-0">Patient Details</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Patient Details</li>
                </ol>
            </div>
           
        </div>
    </div>
</div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-secondary">
                        User Profile
                    </div>
                    <div class="container p-2">
                        <div class="row">
                            <div class="col">
                                <!-- Display user profile information here -->
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><strong>Name:</strong> &nbsp;{{ $user->name }}</td>
                                           
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong>&nbsp;{{ $user->email }}</td>
                                           
                                        </tr>
                                        <tr>
                                            <td><strong>Role:</strong>&nbsp;{{ $user->roles->first()->name ?? 'None' }}</td>
                                            
                                        </tr>
                                        <tr>
                                            <td><strong>Phone number:</strong>&nbsp;{{ $user->phonenum }}</td>
                                           
                                        </tr>
                                        <tr>
                                            <td><strong>Birthdate:</strong>&nbsp;{{ $user->birthdate }}</td>
                                           
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mt-4">
                    <div class="card-header bg-secondary">
                        Appointments
                    </div>
                    <div class="container p-2">
                        <div class="row">
                            <div class="col">
                              
                                @if ($user->appointments && count($user->appointments) > 0)
                                    <table class="table">
                                        <thead>

                                            <th>Appointment Date</th>
                                            <th>Status</th>
                                            <th>Availed Service</th>
                                            <th>Price</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->appointments as $appointment)
                                                <tr>

                                                    <td> {{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y') }}
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

                                                    <td>
                                                        @if ($appointment->status == 0)
                                                            <span>-</span>
                                                        @elseif ($appointment->status == 1)
                                                            <span>-</span>
                                                        @elseif ($appointment->status == 2)
                                                            <span>-</span>
                                                        @elseif ($appointment->status == 3)
                                                            {{ optional($appointment->service)->service_name }}
                                                        @else
                                                            <span class="badge badge-secondary">Unknown</span>
                                                        @endif
                                                    </td>

                                                    <td> @if ($appointment->status == 0)
                                                        <span>-</span>
                                                    @elseif ($appointment->status == 1)
                                                        <span>-</span>
                                                    @elseif ($appointment->status == 2)
                                                        <span>-</span>
                                                    @elseif ($appointment->status == 3)
                                                    ₱{{ optional($appointment->service)->price }}
                                                    @else
                                                        <span class="badge badge-secondary">Unknown</span>
                                                    @endif</td>



                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header bg-secondary">
                        Medical History
                    </div>
                    <div class="container p-2">
                        <div class="row">
                            <div class="col">
                                <!-- Display medical history information here -->
                                @if ($medHistory && count($medHistory) > 0)
                                    <table class="table">
                                        <thead>
                                            <th>Question</th>
                                            <th>Yes</th>
                                            <th>Notes/Description</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($medHistory as $history)
                                                <tr>
                                                    <td>{{ $history->questions->question }}</td>
                                                    <td>{{ $history->yes == 1 ? 'Yes' : 'No' }}</td>
                                                    <td>{{ $history->notes ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No medical history available for this user.</p>
                                @endif
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection
