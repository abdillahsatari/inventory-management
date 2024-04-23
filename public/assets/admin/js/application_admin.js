/*================================================================
						Plugin Init
=================================================================*/
$(document).ready(function() {
	(function ($) {

		$(".knob").knob();

		/**
		/ DataTable
		 **/
		if ($('#example2').length > 0){
			var table = $('#example2').DataTable( {
				lengthChange: false,
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		}

    $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

		/**
		/ select2
		**/
		if ($('.single-select').length > 0){
			$('.single-select').select2({
				theme: 'bootstrap4',
				width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
				placeholder: $(this).data('placeholder'),
				allowClear: Boolean($(this).data('allow-clear')),
			});
		}

		// $(".modal-select").select2({
		// 	theme: "bootstrap4",
		// 	width: $(this).data("width") ? $(this).data("width") : $(this).hasClass("w-100") ? "100%" : "style",
		// 	placeholder: $(this).data("placeholder"),
		// 	allowClear: Boolean($(this).data("allow-clear")),
		// 	dropdownParent: $("#exampleModal"),
		// });

		/**
		/ CKEditor
		 **/
		if ($('#js-ckeditor').length > 0) {
			var _fileBrowser = $('#js-ckeditor').data("kcfinder");
			CKEDITOR.replace('js-ckeditor',{
				filebrowserImageBrowseUrl : _fileBrowser,
				height: '400px'});
		}

	})(jQuery);

});

/*================================================================
						jquery
=================================================================*/


(function($){

	/*================================================================
						Public Function
	=================================================================*/

	/**
	 *
	 * Convert int value into string value
	 *
	 * @param {int} _value
	 * @param {boolean} _isInputType
	 * @returns string
	 */
	function currencyFormatter(_value, _isInputType){
		let _toDecimal	= Number(_value).toFixed(0);
		let returnValue = _toDecimal.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		return  returnValue;
	}

	/**
	 * Convert string value into int value
	 *
	 * @param {string} _value
	 * @returns int
	 */
	function currencyParser(_value){
		return Number(_value.replace(/[^0-9-]+/g,""))
	}

	/**
	 *
	 * @param {string} _value
	 * @returns string
	 */
	function uppercaseSentences(_value){
		return _value.replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase());
	}

	$.fn._getCsrfToken = function(_newToken) {

		if (_newToken) {
			$(this).find('input[name="_token"]').val(_newToken);
			return;
		} else {
			return $(this).find('input[name="_token"]').val();
		}
	};

	$('.js-currencyFormatter').each(function (){
		var _this 		= $(this);
		if (_this.length > 0){
			var dataValue	= _this.data("price");
			var decimal		= Number(dataValue).toFixed(0);
			var returnValue = decimal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			_this.append("<span>Rp. </span>"+returnValue);
		}
	});

	$('.js-input-currencyFormatter').each(function (){
		var _this 		= $(this);
		if (_this.length > 0){
			var dataValue	= _this.data("price");
			var decimal		= Number(dataValue).toFixed(0);
			var returnValue = decimal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			_this.val(returnValue);
		}
	});

	$.fn.modalClose = function(){
		// Reset the modal as default
		$('.modal').on('hidden.bs.modal', function(){
			var _form = $(this);

			_form.find('.invalid-feedback').each(function () {
				$(this).parent().find(".form-control").css("border-color", "");
				$(this).remove();
			});

			_form.find(".form-control").each(function () {
				$(this).val("");
			});

			/**
			 * TO DO
			 * Handle for select2 reset
			 * **/
			// _form.find('select.modal-select').each(function () {
			// 	$(this).select2('data', {}); // clear out values selected
			// 	$(this).select2({allowClear: true}); // re-init to show default status
			// });

		});
	};

	function imagePreview($form, _isCustomLayout){
		$form.find('.js-image_upload').each(function () {
			var _this = $(this);

			_this.on("change", function () {
				var imageObj = window.URL.createObjectURL(_this[0].files[0]);

				if (_isCustomLayout){
					var imgContainer = $form.parent().find(".image-preview");
				}else {
					var imgContainer = _this.parent().find(".image-preview");
				}

				// resizing image preview skip for later
				// look the html structure format example in course/create.php page
				var _imageOptions = imgContainer.data("options");
				imgContainer.attr("src", imageObj);
			});
		});
	};

	function imageUpload($form){
		$form.find('.js-image_upload').each(function () {
			var _this 		= $(this);
			var _url 		= _this.data('url-upload');
			var _fileImage 	= _this[0].files[0];
			var formData 	= new FormData();
			formData.set('file', _fileImage);
			formData.set('_token', $form._getCsrfToken());

			if (_fileImage){
				$.ajax({
					url: _url,
					data: formData,
					type: "post",
					processData: false,
					contentType: false
				}).done(function(result) {
					var obj = $.parseJSON(result);

					if (obj.status == 'success') {
						_this.siblings('input').val(obj.data);
					} else {
						// console.log("tidak terupload karena  :", obj.data);
						// console.log(obj.fileType);
					}

					$form._getCsrfToken(obj.csrf_token);
				});
			}
		});
	}

	function documentUpload($form){
		$form.find('.js-document_upload').each(function () {
			var _this 		= $(this);
			var _url 		= _this.data('url-upload');
			var _fileImage 	= _this[0].files[0];
			var formData 	= new FormData();
			formData.set('file', _fileImage);
			formData.set('_token', $form._getCsrfToken());

			if (_fileImage){
				$.ajax({
					url: _url,
					data: formData,
					type: "post",
					processData: false,
					contentType: false
				}).done(function(result) {
					// console.log("image upload ke :", _url);
					var obj = $.parseJSON(result);

					if (obj.status == 'success') {
						_this.siblings('input').val(obj.data);
						console.log("nama file nya :", obj.data);
						// console.log(obj.fileType);
					} else {
						console.log("tidak terupload karena  :", obj.data);
						// console.log(obj.fileType);
					}

					$form._getCsrfToken(obj.csrf_token);
				});
			}
		});
	}

	function validateForm($form) {
		$form.validate({
			onkeyup: false,
			onfocusout: false,
			ignore: '*:not([name])',
			errorClass: "invalid-feedback",
			errorElement: "p",
			highlight: function(element, errorClass) {
				$(element).removeClass(errorClass);
				$(element).css("border-color", "#dc3545");
			},
			unhighlight: function (element,errorClass) {
				$(element).css("border-color", "");
			},
			errorPlacement: function(error, element) {
				if (element.hasClass('js-input-with-plugin')){
					error.appendTo(element.parent("div").find(".js_input-error-placement"));
				} else if (element.hasClass('js-input-group')){
					error.appendTo(element.parent("div").parent("div").find(".js_input-error-placement"));
				} else {
					error.insertAfter(element);
				}
			},
		});

		$form.find('.js-form_action_btn').on('click', function (event) {
			// event.preventDefault();
			var _this = $(this);

			var _imageUpload = $form.find('.js-image_upload');

			if (_imageUpload.length > 0) {

				var _actionType = "";

				_this.attr('disabled', true);
				switch (_this.html()) {
					case "Submit":
						_actionType = "submit";
						_this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...');
						break;
					default:
						_actionType = "update";
						_this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...');
						break;
				}

				imageUpload($form);
				documentUpload($form)

				setTimeout(function(){
					_this.attr('disabled', false);

					if(_actionType == "update"){
						_this.html("Update")
					} else {
						_this.html("Submit")
					}

					if ($form.valid()){
						$form.submit();
					}
				}, 3000);

			} else {
				if ($form.valid()) {
					$form.submit();
				}
			}
		});
	};

	function copyToClipboard(_target) {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val(_target).select();
		document.execCommand("copy");
		$temp.remove();
	}

	var _target	 = $('.js-targeted_copy_value').val();
	var _btnCopy = $('.js-copy_btn');
	if(_btnCopy.length > 0 ){
		_btnCopy.on("click", function () {
			 copyToClipboard(_target);
		});
	}

	/*================================================================
						Page Function
	=================================================================*/

  /**
	 *
	 * Admin Product Page
	 *
	 **/
	var _createProductModals = $('#createProductModals');
	if (_createProductModals.length > 0){
		_createProductModals.on('shown.bs.modal', function (e) {
			validateForm(_createProductModals.find('.js-form_product_create'));
		});

		_createProductModals.modalClose();
	}

	// deprecaed
	var _editProductModal = $('#editProductModals');
	if (_editProductModal.length > 0) {
		_editProductModal.on('shown.bs.modal', function (e) {
			var _this     = $(this);
			var _dataId   = $(e.relatedTarget).data('id');
			var _dataUrl  = $(e.relatedTarget).data('url');
			var _dataPostUrl  = $(e.relatedTarget).data('post-url');
			var _formEditProduct= _this.find('.js-form_product_edit');

			_this.find('input[name="productId"]').val(_dataId);
      _formEditProduct.attr("action", _dataPostUrl);

			$.ajax({
				type: "GET",
				url: _dataUrl,
        contentType: false,
        processData: false,
			}).done(function(result) {

        if(result.success){
          _this.find('input[name="product_name"]').val(result.data.name);
          _this.find('input[name="product_price"]').val(result.data.price);
          _this.find('input[name="product_point"]').val(result.data.point);
        }

			}).fail(function (error, abc, dfg) {
				console.log("error msg : ", error);
			});

			validateForm(_formEditProduct);
		});

		_editProductModal.modalClose();
	}

  /**
	 *
	 * Admin Customer Page
	 *
	 **/
	var _createCustomerModals = $('#createCustomerModals');
	if (_createCustomerModals.length > 0){
		_createCustomerModals.on('shown.bs.modal', function (e) {
			validateForm(_createCustomerModals.find('.js-form_customer_create'));
		});

		_createCustomerModals.modalClose();
	}

  // deprecaed
	var _editProductModal = $('#editProductModal');
	if (_editProductModal.length > 0) {
		_editProductModal.on('shown.bs.modal', function (e) {
			var _this						= $(this);
			var _dataUrl 				= _this.data('url');
			var _dataProductId  = $(e.relatedTarget).data('id');
			var _formEditProduct= _this.find('.js-form_edit_product');
			var formData  = new FormData();
			formData.set('dataProductId', _dataProductId);
			formData.set('_token', _formEditProduct._getCsrfToken());

			_this.find('input[name="productId"]').val(_dataProductId);

			$.ajax({
				url: _dataUrl,
				data: formData,
				type: "post",
				processData: false,
				contentType: false
			}).done(function(result) {
				var obj = $.parseJSON(result);

				if (obj.status == 'success') {
					_this.find('input[name="product_name"]').val(obj.data["name"]);
					_this.find('input[name="product_price"]').val(obj.data["price"]);
					_this.find('input[name="product_point"]').val(obj.data["point"]);
				}

				_formEditProduct._getCsrfToken(obj.csrf_token);

			}).fail(function (error, abc, efg) {
				console.log("error msg : ", error);
			});

			validateForm(_formEditProduct);
		});

		_editProductModal.modalClose();
	}

	/**
	 *
	 * Cashier Transaction Page
	 *
	 **/
	let _inventorySearch = $('#js_inventory_search');
	if (_inventorySearch.length > 0){

		let _dataUrl = _inventorySearch.data("url");
		let _transactionCartList = $('.js_transaction_table_body');

		_inventorySearch.select2({
			theme: 'bootstrap4',
			minimumInputLength: 3,
			allowClear: true,
			placeholder: 'Masukkan Nama Item',
			ajax: {
				dataType: 'json',
				url: _dataUrl,
				delay: 280,
				data: (params) => {
					let query = {
							search: params.term,
							page: params.page || 1,
					};
					return query;
				},
				processResults: function (data, page) {
					return {
						results: data.data.data.map((inventory) => {
								return { text: inventory.name, id: inventory.id };
						}),
						pagination: {
								more: data.current_page < data.last_page,
						},
				};
			 	},
		 	}
		}).on('select2:select', function (evt) {

			let _url = "search/inventory/"+$(this).val();

			$.ajax({
				type: "GET",
				url: _url,
				contentType: 'json',
			}).done(function(result) {
				if(result.success){
					let _item = result.data;
					let _netto = _item.price;

					if (_item.discount > 0) _netto = _netto - ((_item.discount/100) * _item.price);

					let _subtotal = Number(_netto).toFixed(0);
					let selectedItem = _transactionCartList.find('#item'+_item.id);

					if(selectedItem.length > 0) {
						let itemQuantity = selectedItem.find('.js_item_quantity');
						itemQuantity.val( function(i, val) {return ++val});
						updateQuantity(itemQuantity);
					} else {
						// rendered item
						$('.js_transaction_table_body').append(`
							<tr id="item`+_item.id+`" data-id="`+_item.id+`" data-point="`+_item.point+`">
								<td class="js_item_name">`+ _item.name +`</td>
								<td class="js_item_price">`+ currencyFormatter(_item.price, false) +`</td>
								<td class="js_item_discount">`+ _item.discount +`%</td>
								<td class="js_item_netto">`+ currencyFormatter(_netto, false) +`</td>
								<td><input type="number" name="quantity" value="1" class="form-control js_item_quantity"></td>
								<td class="js_item_subtotal">`+ currencyFormatter(_subtotal, false) +`</td>
								<td>
									<button class="btn btn-small btn-danger"><i class="bx bx-no-entry me-0 js_cart_list_delete" data-price="`+_subtotal+`"></i></button>
								</td>
							</tr>
						`);

						updateTransactionPoint(_item.point);

					}

					updateTotalPrice();

					// update quanity
					$(".js_item_quantity").off().on("change", function(){
						updateQuantity($(this));
					});

					// remove listed cart's item
					$(".js_cart_list_delete").off().on('click', function (e) {
						deleteSelectedItem($(this));
					});

				} else {
					// something
				}
			}).fail(function (errorMsg, status, result) {
			})
		});
	}

	// process transaction
	let _processTransaction = $('#js_process_transaction');
	if(_processTransaction.length > 0){

		function updateTotalPrice(){
			let _grandTotal = 0;
			let _itemSubtotals = $('.js_transaction_table').find('.js_item_subtotal');

			_itemSubtotals.each(function(){
				let _subtotal = $(this).html();
				_grandTotal += currencyParser(_subtotal);
			});

			$('#js_process_transaction').find('input[name="total_price"]').val(currencyFormatter(_grandTotal, true));
		}

		/**
		 *
		 * @param {int} _point
		 */
		function updateTransactionPoint(_point){
			let _currentTransactionPoint = $('.js_transaction_point');
			_currentTransactionPoint.val( function(i, val) {
				let updatedPoint = currencyParser(val) + _point;
				return updatedPoint;
			});
		}

		/**
		 *
		 * @param {object} _dom
		 */
		function updateQuantity(_dom){
			let _itemNetto = _dom.closest("tr").find('.js_item_netto').html();
			let _netto = currencyParser(_itemNetto);
			_updatedSubtotal = _dom.val() * _netto;
			_dom.closest("tr").find('.js_item_subtotal').html(currencyFormatter(_updatedSubtotal, false));
			updateTotalPrice();
		}

		/**
		 *
		 * @param {object} _dom
		 */
		function deleteSelectedItem(_dom){
			let _itemSubtotal = Number(_dom.data("price")).toFixed(0);
			let _quantity = Number(_dom.closest("tr").find('input[name="quantity"]').val());
			let _substractAmount = Number(_quantity*_itemSubtotal);

			_totalPrice = Number($('input[name="total_price"]').val().replace(".", ""));
			_dom.closest('tr').remove();

			updateTotalPrice(_totalPrice - _substractAmount);
		}

		$('.js_proceed_payment').on('click', function(){

			let _totalPrice = currencyParser(_processTransaction.find('input[name="total_price"]').val());
			let _totalPayment = currencyParser(_processTransaction.find('input[name="total_payment"]').val());
			let _totalChange = _processTransaction.find('input[name="total_change"]');

			if(!_totalPayment){
				Lobibox.notify('error', {
					pauseDelayOnHover: true,
					continueDelayOnInactiveTab: false,
					position: 'center top',
					icon: 'bx bx-x-circle',
					size: 'mini',
					msg: 'Nominal Pembayaran Belum di Input'
				});

				return;
			}

			if(!_totalPrice){
				Lobibox.notify('error', {
					pauseDelayOnHover: true,
					continueDelayOnInactiveTab: false,
					position: 'center top',
					icon: 'bx bx-x-circle',
					size: 'mini',
					msg: 'Keranjang Masih Kosong'
				});

				return;
			}

			let paymentChange = _totalPayment - _totalPrice;

			if(paymentChange < 0){
				Lobibox.notify('error', {
					pauseDelayOnHover: true,
					continueDelayOnInactiveTab: false,
					position: 'center top',
					icon: 'bx bx-x-circle',
					size: 'mini',
					msg: 'Nominal Pembayaran Tidak Cukup'
				});
				return;
			} else {
				_totalChange.val(currencyFormatter(paymentChange, false));
				let _customerInfo = $('input[name="customer_id"]').val();

				if(!_customerInfo){
					Lobibox.notify('error', {
						pauseDelayOnHover: true,
						continueDelayOnInactiveTab: false,
						position: 'center top',
						icon: 'bx bx-x-circle',
						size: 'mini',
						msg: 'Informasi Pembeli Belum ditambahkan'
					});
					return;
				}

				let _transactionStoreBtn = $('.js_store_transaction_button');
				let _dataUrlTransaction = _transactionStoreBtn.data("url-transaction");
				let _dataUrlTransactionDetails = _transactionStoreBtn.data("url-transaction-detail");
				_transactionStoreBtn.removeAttr('disabled');

				$('.js_store_transaction_button').on("click", function(){
					// store transaction
					let _transactionTotalPoint = currencyParser($('.js_transaction_point').val());
					let _transactionTotalAmount = currencyParser($('input[name="total_price"]').val());
					let _transactionPayment = currencyParser($('input[name="total_payment"]').val());
					let _transactionChange = currencyParser($('input[name="total_change"]').val());
					let formDataTransaction = new FormData();

					formDataTransaction.set("customer_id", _customerInfo);
					formDataTransaction.set("total_point_earn", _transactionTotalPoint);
					formDataTransaction.set("total_price", _transactionTotalAmount);
					formDataTransaction.set("total_payment", _transactionPayment);
					formDataTransaction.set("total_change", _transactionChange);

					$.ajax({
						url: _dataUrlTransaction,
						data: formDataTransaction,
						type: "post",
						processData: false,
						contentType: false
					}).done(function(result){

						console.log("result ajax: ", result.data);

						// store transaction details
						$('.js_transaction_table_body > tr').each(function(){
							let _this = $(this);
							let _itemId = _this.data("id");
							let _itemPoint = _this.data("point");
							let _itemName = _this.find('.js_item_name').html();
							let _itemDiscount = currencyParser(_this.find('.js_item_discount').html());
							let _itemPrice = currencyParser(_this.find('.js_item_netto').html());
							let _itemQuantity = currencyParser(_this.find('input[name="quantity"]').val());
							let _itemTotalPrice = currencyParser(_this.find('.js_item_subtotal').html());

							let formDataTransactionDetails = new FormData();

							formDataTransactionDetails.set("transaction_id", result.data);
							formDataTransactionDetails.set("inventory_id", _itemId);
							formDataTransactionDetails.set("inventory_name", _itemName);
							formDataTransactionDetails.set("inventory_price", _itemPrice);
							formDataTransactionDetails.set("inventory_discount", _itemDiscount);
							formDataTransactionDetails.set("inventory_total_price", _itemTotalPrice);
							formDataTransactionDetails.set("quantity", _itemQuantity);
							formDataTransactionDetails.set("inventory_point", _itemPoint);

							$.ajax({
								url: _dataUrlTransactionDetails,
								data: formDataTransactionDetails,
								type: "post",
								processData: false,
								contentType: false
							}).done(function(result){
							}).fail(function(){
								// do something if transaction detail failed to store data
							})
						}).promise().done(function () {
							location.reload()
						});

					}).fail(function(error, abc, efg){
						// do something if transaction failed to store data
					});
				});
			}
		});

	}

	// customer search
	let _customerSearch = $('#js_customer_search');
	if(_customerSearch.length > 0){
		let _dataUrl = _customerSearch.data("url");

		_customerSearch.select2({
			theme: 'bootstrap4',
			minimumInputLength: 3,
			allowClear: true,
			placeholder: 'Masukkan Nama Pelanggan',
			ajax: {
				dataType: 'json',
				url: _dataUrl,
				delay: 280,
				data: (params) => {
					let query = {
							search: params.term,
							page: params.page || 1,
					};
					return query;
				},
				processResults: function (data, page) {
					return {
						results: data.data.data.map((customer) => {
								let _displayText = uppercaseSentences(customer.name) + " " + customer.phone_number;
								return { text: _displayText, id: customer.id, customer: data.data.data };
						}),
						pagination: {
								more: data.current_page < data.last_page,
						},
				};
			 	},
		 	}
		}).on('select2:select', function(e){
			let selectedCustomer = e.params.data.customer[0];
			let customerName = uppercaseSentences(selectedCustomer.name);
			let customerPhone = selectedCustomer.phone_number;
			let customerId = selectedCustomer.id;
			let customerInfo = customerName + " " + customerPhone;

			$('input[name="customer_id"]').val(customerId);
			$('.js_transaction_customer').val(customerInfo);
			// add customer current point here

		});
	}

	// remove all listed cart items
	let _resetTransactionTable = $('.js_reset_transaction_table');
	if(_resetTransactionTable.length > 0){
		_resetTransactionTable.on("click", function(){
			$('.js_transaction_table_body').html("");
			$('input[name="total_price"]').val('0');
			$('input[name="total_payment"]').val('');
			$('input[name="total_change"]').val('');
			$('.js_transaction_point').val('0');
		})
	}

})(jQuery);
