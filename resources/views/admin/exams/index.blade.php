@extends('admin.layout')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Exams</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Exams
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
                                <h3 class="card-title">All Exams</h3>

                                <div class="card-tools">
                                    <a href="{{ url('dashboard/exams/create') }}" class="btn btn-primary btn-sm">
                                        Add Exam
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name (EN)</th>
                                            <th>Name (AR)</th>
                                            <th>Image</th>
                                            <th>Skill</th>
                                            <th>Questions Number</th>
                                            <th>Active</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($exams as $exam)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $exam->name('en') }}</td>
                                                <td style="direction: rtl;">{{ $exam->name('ar') }}</td>
                                                <td>
                                                    <img src="{{ asset("storage/uploads/$exam->img") }}" height="50px" alt="">
                                                </td>
                                                <td>{{ $exam->skill->name('en') }}</td>
                                                <td>{{ $exam->questions_no }}</td>
                                                <td>
                                                    @if ($exam->active)
                                                        <a href="#" class="badge badge-success">Active</a>
                                                    @else
                                                        <a href="#" class="badge badge-danger">Deactive</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a style="color: white;"
                                                        href="{{ url("dashboard/exams/show/$exam->id") }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ url("dashboard/exams/show-questions/$exam->id") }}"
                                                        class="btn btn-secondary btn-sm">
                                                        <i class="fas fa-question"></i>
                                                    </a>
                                                    <a href="{{ url("dashboard/exams/edit/$exam->id") }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ url("dashboard/exams/delete/$exam->id") }}"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    @if ($exam->active)
                                                        <a href="{{ url("dashboard/exams/toggle/$exam->id") }}"
                                                            class="btn btn-light btn-sm">
                                                            <i class="fas fa-toggle-on"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ url("dashboard/exams/toggle/$exam->id") }}"
                                                            class="btn btn-light btn-sm">
                                                            <i class="fas fa-toggle-off"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center my-3">
                                    {{ $exams->links() }}
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
