@extends('admin.layout')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Categories</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Categories
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
                                <h3 class="card-title">All Categories</h3>

                                <div class="card-tools">
                                    <button id="add-cart-modat" type="button" class="btn btn-primary btn-sm"
                                        data-toggle="modal" data-target="#new-modal">
                                        Add Category
                                    </button>
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
                                            <th>Active</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cats as $cat)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cat->name('en') }}</td>
                                                <td style="direction: rtl;">{{ $cat->name('ar') }}</td>
                                                <td>
                                                    @if ($cat->active)
                                                        <a href="#" class="badge badge-success">Active</a>
                                                    @else
                                                        <a href="#" class="badge badge-danger">Deactive</a>

                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm edit-btn"
                                                        data-id="{{ $cat->id }}"
                                                        data-name-en="{{ $cat->name('en') }}"
                                                        data-name-ar="{{ $cat->name('ar') }}" data-toggle="modal"
                                                        data-target="#edit-modal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="{{ url("dashboard/categories/delete/$cat->id") }}"
                                                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    @if ($cat->active)
                                                    <a href="{{ url("dashboard/categories/toggle/$cat->id") }}"
                                                        class="btn btn-light btn-sm"><i class="fas fa-toggle-on"></i></a>
                                                    @else
                                                    <a href="{{ url("dashboard/categories/toggle/$cat->id") }}"
                                                        class="btn btn-light btn-sm"><i class="fas fa-toggle-off"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center my-3">
                                    {{ $cats->links() }}
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
    <div class="modal fade" id="new-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-new-cat-form" action="{{ url('dashboard/categories/store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (EN)</label>
                                    <input type="text" class="form-control" name="name_en">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (AR)</label>
                                    <input type="text" class="form-control" name="name_ar">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="add-new-cat-form" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-cat-form" action="{{ url('dashboard/categories/update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="edit-cat-form-id">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (EN)</label>
                                    <input type="text" class="form-control" id="edit-cat-form-name_en" name="name_en">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (AR)</label>
                                    <input type="text" class="form-control" id="edit-cat-form-name_ar" name="name_ar">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="edit-cat-form" class="btn btn-primary">Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
    <script>
        $('.edit-btn').click(function() {
            let id = $(this).attr('data-id');
            let nameEn = $(this).attr('data-name-en');
            let nameAr = $(this).attr('data-name-ar');
            $('#edit-cat-form-id').val(id)
            $('#edit-cat-form-name_en').val(nameEn)
            $('#edit-cat-form-name_ar').val(nameAr)
        })
    </script>
@endsection
