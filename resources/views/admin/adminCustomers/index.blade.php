@extends('admin.adminLayouts.app')

@section('title')
    <title>Admin Pelanggan</title>
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
                    <li class="breadcrumb-item active" aria-current="page">List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createCustomerModals">Tambah Pelanggan</button>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">List Pelanggan</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered customersTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pelanggan</th>
                            <th>No. Hp Pelanggan</th>
                            <th style="width: 40%">Alamat Pelanggan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no=1)
                        @foreach ($c_customerList as $customer)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->phone_number}}</td>
                            <td>{{$customer->address ?: "-"}}</td>
                            <td>
                                <a href="{{ route("admin.customer.edit", ['id' => $customer->id]) }}" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm">
                                    <i class="fadeIn animated bx bx-message-square-edit"></i>
                                </a>
                                <a href="{{ route("admin.customer.destroy", ['id' => $customer->id]) }}" data-original-title="Delete" class="edit btn btn-danger btn-sm">
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
