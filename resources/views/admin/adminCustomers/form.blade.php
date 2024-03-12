@extends('admin.adminLayouts.app')

@section('title')
    <title>Admin Customer</title>
@endsection

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pelanggan</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="col-xl-9 mx-auto">
        <h6 class="mb-0 text-uppercase">Edit Data Pelanggan</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="p-4 border rounded">
                    <form action="{{ route("admin.customer.update", ["id" => $customer["id"]]) }}" method="post" class="row g-3 needs-validation" novalidate>
                        @csrf
                        @method("post")
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Nama Pelanggan</label>
                            <input type="text" name="customer_name" class="form-control" id="validationCustom01" value="{{ $customer["name"] }}" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Nama Pelanggan Tidak Boleh Kosong</div>
                            @if ($errors->has('customer_name'))
                                <div class="text-danger">{{ $errors->first('customer_name') }}</div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">No. Hp</label>
                            <input type="text" name="customer_phone_number" class="form-control" id="validationCustom02" value="{{ $customer["phone_number"] }}" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">No. Hp Tidak Boleh Kosong</div>
                            @if ($errors->has('customer_phone_number'))
                                <div class="text-danger">{{ $errors->first('customer_phone_number') }}</div>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <label for="validationCustom01" class="form-label">Alamat</label>
                            <input type="text" name="customer_address" class="form-control" id="validationCustom03" value="{{ $customer["address"] }}" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Point Tidak Boleh Kosong</div>
                            @if ($errors->has('customer_address'))
                                <div class="text-danger">{{ $errors->first('customer_address') }}</div>
                            @endif
                        </div>
                        <div class="col-12">
                            <a href="{{ route("admin.customer.index") }}" class="btn btn-light mr-3">Kembali</a>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
