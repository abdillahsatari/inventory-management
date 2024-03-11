@extends('admin.adminLayouts.app')

@section('title')
    <title>Admin Products</title>
@endsection

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Produk</div>
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
                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createProductModals">Tambah Produk</button>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">List Produk</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered productsTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Point Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no=1)
                        @foreach ($c_productList as $product)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->point}}</td>
                            <td>
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModals"
                                    data-id="{{ $product->id }}"
                                    data-url="{{ route("admin.ajax.product.edit", ['id' => $product->id]) }}"
                                    data-post-url= "{{ route('admin.product.update', ['id' => $product->id]) }}">
									<i class="fadeIn animated bx bx-message-square-edit"></i>
								</button> --}}
                                <a href="{{ route("admin.product.edit", ['id' => $product->id]) }}" data-toggle="tooltip"  data-id="'{{ $product->id }}'" data-original-title="Edit" class="edit btn btn-primary btn-sm">
                                    <i class="fadeIn animated bx bx-message-square-edit"></i>
                                </a>
                                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'{{ $product->id }}'" data-original-title="Delete" class="edit btn btn-danger btn-sm deleteProduct">
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
