@extends('admin.adminLayouts.app')

@section('title')
    <title>Admin Inventori</title>
@endsection

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Admin</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    {{-- <h6 class="mb-0 text-uppercase">List Inventori</h6> --}}
    <hr />
    <div class="card">
        <div class="card-body">
            Hello Admin !
        </div>
    </div>
@endsection
