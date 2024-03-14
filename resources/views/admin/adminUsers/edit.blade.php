@extends('admin.adminLayouts.app')

@section('title')
    <title>Admin User</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="col-xl-9 mx-auto">
        <h6 class="mb-0 text-uppercase">Edit Data Pengguna</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="p-4 border rounded">
                    <form action="{{ route("admin.user.update", ["user" => $user->id]) }}" method="post" class="row g-3 needs-validation" novalidate>
                        @csrf
                        @method("post")
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Nama Pengguna</label>
                            <input type="text" name="user_name" class="form-control" id="validationCustom01" value="{{ $user->name }}" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Nama Pengguna Tidak Boleh Kosong</div>
                            @error('user_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Username</label>
                            <input type="text" name="user_username" class="form-control" id="validationCustom02" value="{{ $user->username }}" required readonly>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Username Pengguna Tidak Boleh Kosong</div>
                            @error('user_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Email</label>
                            <input type="text" name="user_email" class="form-control" id="validationCustom03" value="{{ $user->email }}" required readonly>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Email Pengguna Tidak Boleh Kosong</div>
                            @error('user_email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Status</label>
                            <select name="user_status" class="single-select js-input-with-plugin form-control" id="user_status" data-rule-required="true" data-msg="Role Pengguna Tidak Boleh Kosong">
                                <option value="" disabled selected>-- Pilih Status Pengguna --</option>
                                <option value="{{ \App\Enums\UserStatusType::ACTIVE() }}" {{ $user->status == \App\Enums\UserStatusType::ACTIVE() ? "selected" : ""}}>{{ \App\Enums\UserStatusType::ACTIVE() }}</option>
                                <option value="{{ \App\Enums\UserStatusType::INACTIVE() }}" {{ $user->status == \App\Enums\UserStatusType::INACTIVE() ? "selected" : ""}}>{{ \App\Enums\UserStatusType::INACTIVE() }}</option>
                            </select>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Status Tidak Boleh Kosong</div>
                            @error('user_status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Role</label>
                            <select name="user_role_id" class="single-select js-input-with-plugin form-control" id="user_role_id" data-rule-required="true" data-msg="Role Pengguna Tidak Boleh Kosong">
                                <option value="" disabled selected>-- Pilih Role Pengguna --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? "selected" : ""}}>{{ $role->role }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Role Tidak Boleh Kosong</div>
                            @error('user_role_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <a href="{{ route("admin.user.index") }}" class="btn btn-light mr-3">Kembali</a>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
