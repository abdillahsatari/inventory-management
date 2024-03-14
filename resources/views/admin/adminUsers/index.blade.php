@extends('admin.adminLayouts.app')

@section('title')
    <title>Admin Users</title>
@endsection

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pengguna</div>
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
                <a href="{{ route("admin.user.create") }}" class="btn btn-light">Tambah Pengguna</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">List Pengguna</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered productsTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pengguna</th>
                            <th>Email Pengguna</th>
                            <th>Role Pengguna</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no=1)
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role->role}}</td>
                            <td>{{$user->status}}</td>
                            <td>
                                <a href="{{ route("admin.user.edit", ['user' => $user->id]) }}" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm">
                                    <i class="fadeIn animated bx bx-message-square-edit"></i>
                                </a>
                                <a href="{{ route("admin.user.destroy", ['user' => $user->id]) }}" data-original-title="Delete" class="edit btn btn-danger btn-sm">
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
