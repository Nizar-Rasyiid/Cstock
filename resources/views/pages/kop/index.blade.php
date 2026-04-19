@extends('layouts.app')

@section('title', 'Edit Kop Surat')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Kop Surat</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('utils.alerts')
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Edit Kop Surat</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kop.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Logo Display -->
                            <div class="form-group">
                                <label for="logo">Logo <span class="text-danger">*</span></label>
                                
                                <!-- Display existing logo if available -->
                                @if($kop->company_logo)
                                    <div>
                                        <img src="{{ asset('storage/'.$kop->company_logo) }}" alt="Current Logo" width="auto" height="150" class="mb-3">
                                    </div>
                                @endif

                                <input type="file" id="logo" class="form-control" name="logo" accept="image/*">
                            </div>

                            <div class="form-group">
                                <label for="company_name">Nama Perusahaan <span class="text-danger">*</span></label>
                                <input type="text" id="company_name" class="form-control" name="company_name" value="{{ $kop->company_name ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat <span class="text-danger">*</span></label>
                                <input type="text" id="address" class="form-control" name="address" value="{{ $kop->company_address ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" class="form-control" name="email" value="{{ $kop->company_email ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">No Telepon <span class="text-danger">*</span></label>
                                <input type="text" id="phone" class="form-control" name="phone" value="{{ $kop->company_phone ?? '' }}" required>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-check"></i> Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
