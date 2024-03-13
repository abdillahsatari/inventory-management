@extends('admin.adminLayouts.app')

@section('title')
    <title>Admin Inventory</title>
@endsection

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Inventory</div>
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
        <h6 class="mb-0 text-uppercase">Edit Inventory</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="p-4 border rounded">
                    <form action="{{ route("admin.inventory.update", ["id" => $inventory["id"]]) }}" method="post" class="row g-3 needs-validation" novalidate>
                        @csrf
                        @method("post")
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Nama Produk</label>
                            <input type="text" name="inventory_name" class="form-control" id="validationCustom01" value="{{ $inventory["name"] }}" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Nama Produk Tidak Boleh Kosong</div>
                            @if ($errors->has('inventory_name'))
                                <div class="text-danger">{{ $errors->first('inventory_name') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Harga</label>
                            <input type="text" name="inventory_price" class="form-control" id="validationCustom02" value="{{ $inventory["price"] }}" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Harga Tidak Boleh Kosong</div>
                            @error('inventory_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Point</label>
                            <input type="text" name="inventory_point" class="form-control" id="validationCustom03" value="{{ $inventory["point"] }}" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Point Tidak Boleh Kosong</div>
                            @error('inventory_point')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Stock</label>
                            <input type="text" name="inventory_stock" class="form-control" id="validationCustom03" value="{{ $inventory["stock"] }}" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Point Tidak Boleh Kosong</div>
                            @if ($errors->has('inventory_stock'))
                                <div class="text-danger">{{ $errors->first('inventory_stock') }}</div>
                            @endif
                        </div>

                        <div class="col-12">
                            <a href="{{ route("admin.inventory.index") }}" class="btn btn-light mr-3">Kembali</a>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
