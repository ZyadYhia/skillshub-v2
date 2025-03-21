@extends('admin.layout')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Exam
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
                        @include('admin.includes.errors')
                        <form id="add-new-form" action="{{ url("dashboard/exams/store-questions/$exam_id") }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                @for ($i = 1; $i <= $questions_no; $i++)
                                    <h5>Question {{ $i }}</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="titles[]">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Right Ans.</label>
                                                <input type="text" class="form-control" name="right_anss[]">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Option 1</label>
                                                <input type="text" class="form-control" name="option_1s[]">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Option 2</label>
                                                <input type="text" class="form-control" name="option_2s[]">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Option 3</label>
                                                <input type="text" class="form-control" name="option_3s[]">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Option 4</label>
                                                <input type="text" class="form-control" name="option_4s[]">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endfor
                            </div>
                        </form>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" form="add-new-form" class="btn btn-success">Submit</button>
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
