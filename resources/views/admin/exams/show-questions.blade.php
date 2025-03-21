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
                                            <th>Title</th>
                                            <th>Options</th>
                                            <th>Right Answer</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($exam->questions as $ques)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ques->title }}</td>
                                                <td>
                                                    |{{ $ques->option_1 }} <br>
                                                    |{{ $ques->option_2 }} <br>
                                                    |{{ $ques->option_3 }} <br>
                                                    |{{ $ques->option_4 }}
                                                </td>
                                                <td>
                                                    {{ $ques->right_ans }}
                                                </td>
                                                <td>
                                                    <a href="{{ url("dashboard/exams/edit-questions/$exam->id/$ques->id") }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Back</a>
                        <a href="{{ url('dashboard/exams') }}" class="btn btn-primary btn-sm">Back to all Exams</a>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
