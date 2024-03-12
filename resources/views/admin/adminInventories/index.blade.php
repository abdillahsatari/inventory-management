@extends('admin.adminLayouts.app')

@section('title')
    <title>Admin Products</title>
@endsection

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Inventori</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createProductModals">Tambah Inventori</button>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">List Inventori</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered productsTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Inventori</th>
                            <th>Harga Inventori</th>
                            <th>Point Inventori</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no=1)
                        @foreach ($inventories as $inventory)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$inventory->name}}</td>
                            <td>{{$inventory->price}}</td>
                            <td>{{$inventory->point}}</td>
                            <td>{{$inventory->stock}}</td>
                            <td>
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModals"
                                    data-id="{{ $product->id }}"
                                    data-url="{{ route("admin.ajax.product.edit", ['id' => $product->id]) }}"
                                    data-post-url= "{{ route('admin.product.update', ['id' => $product->id]) }}">
									<i class="fadeIn animated bx bx-message-square-edit"></i>
								</button> --}}
                                <a href="{{ route("admin.inventory.edit", ['id' => $inventory->id]) }}" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm">
                                    <i class="fadeIn animated bx bx-message-square-edit"></i>
                                </a>
                                <a href="{{ route("admin.inventory.destroy", ['id' => $inventory->id]) }}" data-original-title="Delete" class="edit btn btn-danger btn-sm">
                                    <i class="fadeIn animated bx bx-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
