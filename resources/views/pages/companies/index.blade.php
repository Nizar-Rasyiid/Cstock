@extends('layouts.app')

@section('title', 'Company Management')

@section('third_party_stylesheets')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Companies</li>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#companyCreateModal">
                        Add Company <i class="bi bi-plus"></i>
                    </button>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped" id="company-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Expired Membership</th>
                                    <th>Membership Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->address }}</td>
                                    <td>{{ $company->phone }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($company->expired_membership)->format('d-m-Y') }}</td>
                                    <td>Rp {{ number_format($company->membership_price, 0, ',', '.') }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#companyEditModal{{ $company->id }}">
                                            Edit
                                        </button>
                                        <!-- Delete Button -->
                                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this company?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="companyEditModal{{ $company->id }}" tabindex="-1" role="dialog" aria-labelledby="companyEditModalLabel{{ $company->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="companyEditModalLabel{{ $company->id }}">Edit Company</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('companies.update', $company->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Name <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="name" required value="{{ $company->name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Address <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="address" required value="{{ $company->address }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Phone <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="phone" required value="{{ $company->phone }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="email" name="email" required value="{{ $company->email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="expired_membership">Expired Membership <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="date" name="expired_membership" required value="{{ \Carbon\Carbon::parse($company->expired_membership)->format('Y-m-d') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="membership_price">Membership Price <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="number" name="membership_price" required value="{{ $company->membership_price }}">
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

    <div class="modal fade" id="companyCreateModal" tabindex="-1" role="dialog" aria-labelledby="companyCreateModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="companyCreateModalLabel">Create Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('companies.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="expired_membership">Expired Membership <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="expired_membership" required>
                        </div>
                        <div class="form-group">
                            <label for="membership_price">Membership Price <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="membership_price" required>
                        </div>
                        <div class="form-group">
                            <label for="membership_price">Generate Users <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="users" required>
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
    $('#company-table').DataTable();
});
</script>
@endpush
