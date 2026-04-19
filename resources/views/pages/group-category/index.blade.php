@extends('layouts.app')

@section('title', 'Product Categories')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
        <li class="breadcrumb-item active">Group Categories</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('utils.alerts')
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryCreateModal">
                            Add Category <i class="bi bi-plus"></i>
                        </button>

                        <hr>

                        <div class="table-responsive">
                            <table class="table table-striped" id="category-table">
                                <thead>
                                    <tr>
                                        <th>Category Code</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->category_code }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#categoryEditModal{{ $category->id }}">
                                                    Edit
                                                </button>
                                                <!-- Delete Button -->
                                                <form action="{{ route('product-group-categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="categoryEditModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="categoryEditModalLabel{{ $category->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="categoryEditModalLabel{{ $category->id }}">Edit Category</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('product-group-categories.update', $category->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="category_code">Category Code <span class="text-danger">*</span></label>
                                                                <input class="form-control" type="text" name="category_code" required value="{{ $category->category_code }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="category_name">Category Name <span class="text-danger">*</span></label>
                                                                <input class="form-control" type="text" name="category_name" required value="{{ $category->category_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Update <i class="bi bi-check"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $category_max_id = \Modules\Product\Entities\Category::max('id') + 1;
        $category_code = "CA_" . str_pad($category_max_id, 2, '0', STR_PAD_LEFT);
    @endphp

    <div class="modal fade" id="categoryCreateModal" tabindex="-1" role="dialog" aria-labelledby="categoryCreateModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryCreateModalLabel">Create Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('product-group-categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_code">Category Code <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="category_code" required value="{{ $category_code }}">
                        </div>
                        <div class="form-group">
                            <label for="category_name">Category Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="category_name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create <i class="bi bi-check"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('#category-table').DataTable();
        });
    </script>
@endpush
