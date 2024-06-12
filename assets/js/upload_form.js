$(function () {
	var inputFile = $('input#file');
	var uploadURI = $('#form-upload').attr('action');
	var progressBar = $('#progress-bar');
	var inputFileKey = $('input[name=upload_file_key]');
	var uploadURIKey = $('#form-upload-key').attr('action');

	var form_1 = document.querySelector(".form_1");
	var form_2 = document.querySelector(".form_2");
	var form_3 = document.querySelector(".form_3");


	var form_1_btns = document.querySelector(".form_1_btns");
	var form_2_btns = document.querySelector(".form_2_btns");
	var form_3_btns = document.querySelector(".form_3_btns");


	var form_1_next_btn = document.querySelector(".form_1_btns .btn_next");
	var form_2_back_btn = document.querySelector(".form_2_btns .btn_back");
	var form_2_next_btn = document.querySelector(".form_2_btns .btn_next");
	var form_3_back_btn = document.querySelector(".form_3_btns .btn_back");

	var form_2_progessbar = document.querySelector(".form_2_progessbar");
	var form_3_progessbar = document.querySelector(".form_3_progessbar");

	var btn_done = document.querySelector(".btn_done");
	var btn_back = document.querySelector(".btn_back");
	var modal_wrapper = document.querySelector(".modal_wrapper");
	var shadow = document.querySelector(".shadow");

	form_1_next_btn.addEventListener("click", function () {
		form_1.style.display = "none";
		form_2.style.display = "block";

		form_1_btns.style.display = "none";
		form_2_btns.style.display = "flex";

		form_2_progessbar.classList.add("active");
	});

	form_2_back_btn.addEventListener("click", function () {
		form_1.style.display = "block";
		form_2.style.display = "none";

		form_1_btns.style.display = "flex";
		form_2_btns.style.display = "none";

		form_2_progessbar.classList.remove("active");
	});

	form_2_next_btn.addEventListener("click", function () {
		form_2.style.display = "none";
		form_3.style.display = "block";

		form_3_btns.style.display = "none";
		form_2_btns.style.display = "none";

		
		
		form_3_progessbar.classList.add("active");
		
	});

	form_3_back_btn.addEventListener("click", function () {
		form_2.style.display = "block";
		form_3.style.display = "none";

		form_3_btns.style.display = "none";
		form_2_btns.style.display = "flex";

		form_3_progessbar.classList.remove("active");
	});

	btn_done.addEventListener("click", function () {
		modal_wrapper.classList.add("active");
	})

	shadow.addEventListener("click", function () {
		modal_wrapper.classList.remove("active");
	})

	$('#btn-upload-key').on('click', function (even) {
		var made = $('#made').val();
		even.preventDefault();
		if (made == "") {
			alert("Bạn cần nhập mã đề");
		}
		else {
			var fileToUpload = inputFileKey[0].files[0];
			if (fileToUpload != 'undefined') {
				var formDataKey = new FormData();
				formDataKey.append("upload_file_key", fileToUpload);
				$.ajax({
					url: uploadURIKey,
					type: 'post',
					data: formDataKey,
					processData: false,
					contentType: false,
					success: function () {
						alert("Thêm file đáp án thành công");
					}
				});
			}
			if (fileToUpload == null) {
				alert('Chưa thêm file hoặc sai định dạng');
			}
		}
	});

	$('#upload-btn').on('click', function (event) {
		var filesToUpload = inputFile[0].files;
		event.preventDefault();
		// make sure there is file(s) to upload
		if (filesToUpload.length > 0) {
			// provide the form data
			// that would be sent to sever through ajax
			var formData = new FormData();

			for (var i = 0; i < filesToUpload.length; i++) {
				var file = filesToUpload[i];

				formData.append("file[]", file, file.name);
				}

			// now upload the file using $.ajax
			$.ajax({
				url: uploadURI,
				type: 'post',
				data: formData,
				processData: false,
				contentType: false,
				success: function () {
					listFilesOnServer();
					// alert("Thành công");
				},
				xhr: function () {
					var xhr = new XMLHttpRequest();
					xhr.upload.addEventListener("progress", function (event) {
						if (event.lengthComputable) {
							var percentComplete = Math.round((event.loaded / event.total) * 100);
							// console.log(percentComplete);

							$('.progress').show();
							progressBar.css({ width: percentComplete + "%" });
							progressBar.text(percentComplete + '%');
						};
					}, false);

					return xhr;
				}
			});
		}
	});

	$('body').on('click', '.remove-file', function () {
		var me = $(this);

		$.ajax({
			url: uploadURI,
			type: 'post',
			data: { file_to_remove: me.attr('data-file') },
			success: function () {
				me.closest('li').remove();
				$('.progress').hide();
				progressBar.text("0%");
				progressBar.css({ width: "0%" });
			}
		});

	})

	function listFilesOnServer() {
		var items = [];
		$.getJSON(uploadURI, function (data) {
			$.each(data, function (index, element) {
				items.push('<li class="list-group-item">' + element + '<div class="pull-right"><a href="#" data-file="' + element + '" class="remove-file"><i class="glyphicon glyphicon-remove"></i></a></div></li>');
			});
			$('.list-group').html("").html(items.join(""));
		});
	}

	$('body').on('change.bs.fileinput', function (e) {
		$('.progress').hide();
		progressBar.text("0%");
		progressBar.css({ width: "0%" });
	});
});