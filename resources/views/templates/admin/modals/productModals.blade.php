<!-- Modal -->
<div class="modal fade" id="createProductModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.product.store') }}" method="POST" class="js-form_product_create">
                @csrf
                <div class="modal-body">
                    <label>Nama Produk</label>
                    <input type="text" name="product_name" class="form-control" data-rule-required="true" data-msg="Nama Produk Tidak Boleh Kosong">
                    @if($errors->has('product_name'))
                        <div class="text-danger">{{ $errors->first('product_name') }}</div>
                    @endif
                    <br>
                    <label>Harga</label>
                    <input type="number" name="product_price" class="form-control" data-rule-required="true" data-msg="Harga Produk Tidak Boleh Kosong">
                    @if($errors->has('product_price'))
                        <div class="text-danger">{{ $errors->first('product_price') }}</div>
                    @endif
                    <br>
                    <label>Point</label>
                    <input type="number" name="product_point" class="form-control" data-rule-required="true" data-msg="Point Produk Tidak Boleh Kosong">
                    @if($errors->has('product_point'))
                        <div class="text-danger">{{ $errors->first('product_point') }}</div>
                    @endif
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary js-form_action_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
