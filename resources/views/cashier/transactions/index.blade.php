@extends('admin.adminLayouts.app')

@section('title')
    <title>Transaksi Penjualan</title>
@endsection

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Kasir</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Transaksi Penjualan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row" id="js_cashier_transactions">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="animated fadeIn bx bx-search"></div> Cari Barang
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <select name="search" class="form-select" id="js_inventory_search"
                                        data-url="{{ route('cashier.inventories.search') }}">
                                </select>
                                <button class="btn btn-outline-secondary" type="button"><i class='bx bx-search'></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="bx bx-user-circle"></div> Cari Pelanggan
                </div>
                <div class="card-body">
                    <div class="row row-cols-auto g-3">
                        <div class="col-md-10">
                            <div class="input-group">
                                <select name="search" class="form-select" id="js_customer_search"
                                        data-url="{{ route('cashier.customers.search') }}">
                                </select>
                                <button class="btn btn-outline-secondary" type="button"><i class='bx bx-search'></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary js_cashier_add_customer" type="button" data-bs-toggle="modal" data-bs-target="#createCustomerModals">
                            <i class='bx bx-user-plus'></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-none d-sm-flex align-items-center">
                        <div class="pe-3"><h6><i class="animated fadeIn bx bx-cart"></i> Keranjang Belanja</h6></div>
                        <div class="ms-auto">
                            <button class="btn btn-xs btn-danger js_reset_transaction_table">Reset Keranjang</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="">Kasir:</label>
                            <input type="text" value="{{ auth()->guard('cashier')->user()->name }}" class="js_transaction_cashier form-control" disabled readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Tanggal Transaksi: </label>
                            <input type="text" value="{{ date('d M Y', strtotime(now())) }}" class="js_transaction_cashier form-control" disabled readonly>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label for="">Pelanggan:</label>
                            <input type="text" placeholder="-" class="js_transaction_customer form-control" disabled readonly>
                            <input type="hidden" name="customer_id" class="form-control" disabled readonly>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Point Pelanggan: </label>
                                    <div class="input-group mb-3">
                                        <input type="number" placeholder="-" class="js_customer_point form-control" disabled readonly>
                                        <button class="btn btn-light" type="button" id="button-addon2">Point</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Point Belanja: </label>
                                    <div class="input-group mb-3">
                                        <input type="number" value="0" placeholder="-" class="js_transaction_point form-control" aria-label="Recipient's username" aria-describedby="button-addon2" disabled readonly>
                                        <button class="btn btn-light" type="button" id="button-addon2">Point</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table mb-10 js_transaction_table">
                        <thead class="table-dark">
                            <tr>
                                {{-- <th scope="col">No.</th> --}}
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Netto</th>
                                <th scope="col">Quanity</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="js_transaction_table_body">
                        </tbody>
                    </table>

                    <div class="row" id="js_process_transaction">
                        <div class="col-md-3">
                            <label for="">Total:</label>
                            <div class="input-group mb-3">
                                <button class="btn btn-light" type="button" id="button-addon1">Rp.</button>
                                <input type="number" name="total_price" class="form-control" value="0"
                                        readonly disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">Bayar:</label>
                            <div class="input-group mb-3">
                                <button class="btn btn-light" type="button" id="button-addon1">Rp.</button>
                                <input type="number" name="total_payment" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">Kembalian:</label>
                            <div class="input-group mb-3">
                                <button class="btn btn-light" type="button" id="button-addon1">Rp.</button>
                                <input type="number" name="total_change" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 ms-auto align-items-center">
                            <label for="">Proses:</label>
                            <br>
                            <button class="btn btn-small btn-success js_proceed_payment">Bayar</button>
                            <button class="btn btn-small btn-primary js_store_transaction_button"
                                data-url-transaction="{{ route("cashier.transaction.store") }}"
                                data-url-transaction-detail="{{ route("cashier.transaction.detail.store") }}"
                                disabled>Selesai</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
