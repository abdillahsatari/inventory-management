<!-- Modal -->
<div class="modal fade" id="createProductModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Inventory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.inventory.store') }}" method="POST" class="js-form_product_create">
                @csrf
                <div class="modal-body">
                    <label>Nama Inventory</label>
                    <input type="text" name="inventory_name" class="form-control" data-rule-required="true"
                        data-msg="Nama Inventori Tidak Boleh Kosong">
                    @if ($errors->has('inventory_name'))
                        <div class="text-danger">{{ $errors->first('inventory_name') }}</div>
                    @endif
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Harga</label>
                    <input type="number" name="inventory_price" class="form-control" data-rule-required="true"
                        data-msg="Harga Inventory Tidak Boleh Kosong">
                    @if ($errors->has('inventory_price'))
                        <div class="text-danger">{{ $errors->first('inventory_price') }}</div>
                    @endif
                        </div>
                        <div class="col-md-4">
                            <label>Point</label>
                    <input type="number" name="inventory_point" class="form-control" data-rule-required="true"
                        data-msg="Point Inventori Tidak Boleh Kosong">
                    @if ($errors->has('inventory_point'))
                        <div class="text-danger">{{ $errors->first('inventory_point') }}</div>
                    @endif
                        </div>
                        <div class="col-md-4">
                            <label>Stock</label>
                            <input type="number" name="inventory_stock" class="form-control" data-rule-required="true"
                                data-msg="Stock Inventori Tidak Boleh Kosong">
                            @if ($errors->has('inventory_stock'))
                                <div class="text-danger">{{ $errors->first('inventory_stock') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary js-form_action_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editProductModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    {{-- data-url="<?= base_url('admin/adminAjax/showAdminCourseTypeDetail') ?>"> --}}
    {{-- data-url="{{ route('admin.ajax.editProducts') }}" --}}
    >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="put" class="js-form_product_edit">
                @csrf
                @method('put')
                <input type="hidden" name="productId" value="" class="form-control">
                <div class="modal-body">
                    <label>Nama Produk</label>
                    <input type="text" name="product_name" class="form-control" data-rule-required="true"
                        data-msg="Nama Produk Tidak Boleh Kosong">
                    @if ($errors->has('product_name'))
                        <div class="text-danger">{{ $errors->first('product_name') }}</div>
                    @endif
                    <br>
                    <label>Harga</label>
                    <input type="number" name="product_price" class="form-control" data-rule-required="true"
                        data-msg="Harga Produk Tidak Boleh Kosong">
                    @if ($errors->has('product_price'))
                        <div class="text-danger">{{ $errors->first('product_price') }}</div>
                    @endif
                    <br>
                    <label>Point</label>
                    <input type="number" name="product_point" class="form-control" data-rule-required="true"
                        data-msg="Point Produk Tidak Boleh Kosong">
                    @if ($errors->has('product_point'))
                        <div class="text-danger">{{ $errors->first('product_point') }}</div>
                    @endif
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary js-form_action_btn">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
