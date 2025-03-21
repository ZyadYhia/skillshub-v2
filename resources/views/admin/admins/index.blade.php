@extends('admin.layout')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Admins</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Admins
                            </li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @include('admin.includes.messages')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Admins</h3>

                                {{-- <div class="card-tools">
                                    <button id="add-cart-modat" type="button" class="btn btn-primary btn-sm"
                                        data-toggle="modal" data-target="#new-modal">
                                        Add Admin
                                    </button>
                                </div> --}}
                                <div class="card-tools">
                                    <a href="{{ url('dashboard/admins/create') }}" class="btn btn-primary btn-sm">
                                        Add Admin
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Verified</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td>{{ $admin->role }}</td>
                                                <td>
                                                    @if ($admin->email_verified_at)
                                                        <span class="badge badge-success">Verified</span>
                                                    @else
                                                        <span class="badge badge-danger">Not Verified</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($admin->role == 'admin')
                                                        <a href="{{ url("dashboard/admins/promote/$admin->id") }}"
                                                            class="btn btn-success btn-sm"><i
                                                                class="fas fa-level-up-alt"></i></a>
                                                    @else
                                                        <a href="{{ url("dashboard/admins/demote/$admin->id") }}"
                                                            class="btn btn-warning btn-sm"><i
                                                                class="fas fa-level-down-alt"></i></a>
                                                    @endif
                                                    <a href="{{ url("dashboard/admins/delete/$admin->id") }}"
                                                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    @if ($admin->email_verified_at)
                                                        <a href="{{ url("dashboard/admins/remove-verification/$admin->id") }}"
                                                            class="btn btn-primary btn-sm"><i
                                                                class="fas fa-user-check"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center my-3">
                                    {{ $admins->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
