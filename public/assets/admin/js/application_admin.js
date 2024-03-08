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
		// if ($('.single-select').length > 0){
		// 	$('.single-select').select2({
		// 		theme: 'bootstrap4',
		// 		width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
		// 		placeholder: $(this).data('placeholder'),
		// 		allowClear: Boolean($(this).data('allow-clear')),
		// 	});
		// }

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
			// _this.append("<span>Rp. </span>"+returnValue);
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
					// console.log("image upload ke :", _url);
					var obj = $.parseJSON(result);

					if (obj.status == 'success') {
						_this.siblings('input').val(obj.data);
						// console.log("nama file nya :", obj.data);
						// console.log(obj.fileType);
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
			event.preventDefault();
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
	 * Admin Course Categories Page
	 *
	 **/
	var _createProductModals = $('#createProductModals');
	if (_createProductModals.length > 0){
		_createProductModals.on('shown.bs.modal', function (e) {
			validateForm(_createProductModals.find('.js-form_product_create'));
		});

		_createProductModals.modalClose();
	}

  // later on
	var _editCourseCategoriesModal = $('#editCourseCategoriModal');
	if (_editCourseCategoriesModal.length > 0) {
		_editCourseCategoriesModal.on('shown.bs.modal', function (e) {
			var _this						= $(this);
			var _dataUrl 					= _this.data('url');
			var _dataCourseCategoryId		= $(e.relatedTarget).data('id');
			var _formEditCourseCategory 	= _this.find('.js-form_course_category');
			var formData 					= new FormData();
			formData.set('dataCourseCategoryId', _dataCourseCategoryId);
			formData.set('_token', _formEditCourseCategory._getCsrfToken());

			_this.find('input[name="course_category_id"]').val(_dataCourseCategoryId);

			$(".modal-select").select2({
				theme: "bootstrap4",
				width: $(this).data("width") ? $(this).data("width") : $(this).hasClass("w-100") ? "100%" : "style",
				placeholder: $(this).data("placeholder"),
				allowClear: Boolean($(this).data("allow-clear")),
				dropdownParent: _editCourseCategoriesModal,
			});

			$.ajax({
				url: _dataUrl,
				data: formData,
				type: "post",
				processData: false,
				contentType: false
			}).done(function(result) {
				var obj = $.parseJSON(result);

				if (obj.status == 'success') {
					_this.find('input[name="course_category_headline"]').val(obj.data["course_category_headline"]);
					$(".modal-select").select2('val', obj.data["course_category_status"]);
				}

				_formEditCourseCategory._getCsrfToken(obj.csrf_token);

			}).fail(function (error, abc, dfg) {
				console.log("error msg : ", error);
			});

			validateForm(_formEditCourseCategory);
		});

		_editCourseCategoriesModal.modalClose();
	}

})(jQuery);
