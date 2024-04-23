<!-- Modal -->
<div class="modal fade" id="createCustomerModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" class="js-form_customer_create">
                @csrf
                <div class="modal-body">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="customer_name" class="form-control" data-rule-required="true" data-msg="Nama Pelanggan Tidak Boleh Kosong">
                    @if($errors->has('customer_name'))
                        <div class="text-danger">{{ $errors->first('customer_name') }}</div>
                    @endif
                    <br>
                    <label>No. Hp</label>
                    <input type="number" name="customer_phone_number" class="form-control" data-rule-required="true" data-msg="No. Hp Tidak Boleh Kosong">
                    @if($errors->has('customer_phone_number'))
                        <div class="text-danger">{{ $errors->first('customer_phone_number') }}</div>
                    @endif
                    <br>
                    <label>Alamat Pelanggan</label>
                    <input type="text" name="customer_address" class="form-control" data-msg="Alamat Pelanggan Tidak Boleh Kosong">
                    @if($errors->has('customer_address'))
                        <div class="text-danger">{{ $errors->first('customer_address') }}</div>
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
