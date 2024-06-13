$(function () {
	var inputFile = $('input#file');
	var uploadURI = $('#form-upload').attr('action');
	var progressBar = $('#progress-bar');
	var inputFileKey = $('input[name=upload_file_key]');
	var uploadURIKey = $('#form-upload-key').attr('action');

	
	$('#btn-upload-key').on('click', function (even) {
		var made = $('#made').val();
		even.preventDefault();
		if (made == "") {
			alert("Bạn cần nhập mã đề");
		}
		if (mamon == "" || mamon == null) {
			alert("Mã môn không được để trống");
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
		// make sure there is file(s) to upload
		if (filesToUpload.length > 0) {
			// provide the form data
			// that would be sent to sever through ajax
			var formData = new FormData();

			for (var i = 0; i < filesToUpload.length; i++) {
				var file = filesToUpload[i];

				formData.append("file[]", file, file.name);
			}
			console.log(formData);
			// now upload the file using $.ajax
			$.ajax({
				url: uploadURI,
				type: 'post',
				data: formData,
				processData: false,
				contentType: false,
				success: function () {
					listFilesOnServer();
					$('#btn-save-result').show();
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