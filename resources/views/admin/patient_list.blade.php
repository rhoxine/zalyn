

@extends('admin.layouts')

@section('content')
    <main>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-6">
                        <h1 class="m-0">Patient List</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Patient List</li>
                        </ol>
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card p-3 shadow" style="overflow-x:auto;">
                        <!-- Your existing table structure goes here -->
                        <table id='usersTable' class='display responsive table w-100' cellspacing="0">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                
                                <th width="50px">Action</th>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @foreach ($users as $user)
                                    @php
                                        $userRole = $user->roles->first();
                                    @endphp
                                
                                    @if ($userRole && $userRole->name == 'User')
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            
                                            <td>
                                                <a href="{{ route('users.profile', $user->id) }}" class="text-info me-2">
                                                    <i class='fa fa-eye'></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $count++; ?>
                                    @endif
                                @endforeach
                                

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable();
        });
    </script>
@endsection
