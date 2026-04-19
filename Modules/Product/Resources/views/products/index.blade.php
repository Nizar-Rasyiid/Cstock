@extends('layouts.app')

@section('title', 'Products')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Products</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            Add Product <i class="bi bi-plus"></i>
                        </a>

                        <hr>

                        <select id="supplier-filter" class="form-control mb-4">
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" 
                                    @if(request()->get('supplier_id') == $supplier->id) selected @endif>
                                    {{ $supplier->supplier_name }}
                                </option>
                            @endforeach
                        </select>


                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {
            // On change of supplier filter
            $('#supplier-filter').change(function() {
                var supplierId = $(this).val();
                var baseUrl = window.location.pathname; // Get the base URL
                var queryString = supplierId ? '?supplier_id=' + supplierId : ''; // Construct query string

                // Refresh the page with the new supplier_id parameter
                window.location.href = baseUrl + queryString;
            });
        });
    </script>
@endpush
