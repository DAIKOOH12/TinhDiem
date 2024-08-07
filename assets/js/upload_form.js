$(function () {
  var inputFile = $("input#file");
  var uploadURI = $("#form-upload").attr("action");
  var progressBar = $("#progress-bar");
  var inputFileKey = $("input[name=upload_file_key]");
  var uploadURIKey = $("#form-upload-key").attr("action");

  var form_1 = document.querySelector(".form_1");
  var form_2 = document.querySelector(".form_2");
  var form_3 = document.querySelector(".form_3");
  var form_4 = document.querySelector(".form_4");

  var form_1_btns = document.querySelector(".form_1_btns");
  var form_2_btns = document.querySelector(".form_2_btns");
  var form_3_btns = document.querySelector(".form_3_btns");
  var form_4_btns = document.querySelector(".form_4_btns");

  var form_1_next_btn = document.querySelector(".form_1_btns .btn_next");
  var form_2_back_btn = document.querySelector(".form_2_btns .btn_back");
  var form_2_next_btn = document.querySelector(".form_2_btns .btn_next");
  var form_3_back_btn = document.querySelector(".form_3_btns .btn_back");
  var form_3_next_btn = document.querySelector(".form_3_btns .btn_next");

  var form_2_progessbar = document.querySelector(".form_2_progessbar");
  var form_3_progessbar = document.querySelector(".form_3_progessbar");
  var form_4_progessbar = document.querySelector(".form_4_progessbar");

  var btn_done = document.querySelector(".btn_done");
  var btn_back = document.querySelector(".btn_back");
  var modal_wrapper = document.querySelector(".modal_wrapper");
  var shadow = document.querySelector(".shadow");

  let url_upload_files = baseURL + "/upload_files";
  var url_removePTL = baseURL + "/removePTL";
  var url_state = baseURL + "/state";
  var url_themdapan = baseURL + "/themdapan";

  var selectedMon = $("#dsmon").children("option:selected").html();
  $("#dsmon").on("change", function (e) {
    selectedMon = $(this).children("option:selected").html();
  });
  form_1_next_btn.addEventListener("click", function () {
    form_1.style.display = "none";
    form_2.style.display = "block";

    form_1_btns.style.display = "none";
    form_2_btns.style.display = "flex";

    $("#current-mon").html(selectedMon);
    form_2_progessbar.classList.add("active");
  });

  form_2_back_btn.addEventListener("click", function () {
    console.log("back");
    form_1.style.display = "block";
    form_2.style.display = "none";

    form_1_btns.style.display = "flex";
    form_2_btns.style.display = "none";

    form_2_progessbar.classList.remove("active");
  });

  form_2_next_btn.addEventListener("click", function () {
    form_2.style.display = "none";
    form_3.style.display = "block";

    form_3_btns.style.display = "flex";
    form_2_btns.style.display = "none";

    form_3_progessbar.classList.add("active");
    // var formData = new FormData($('#form-upload-dapan')[0]);
    // console.log(formData);
    // $.ajax({
    // 	url: window.location.href + "/themdapan",
    // 	type: 'POST',
    // 	data: formData,
    // 	success: function (data) {
    // 		alert("Thành công");
    // 	},
    // 	cache: false,
    // 	contentType: false,
    // 	processData: false
    // });
  });

  form_3_back_btn.addEventListener("click", function () {
    // console.log('back');
    form_2.style.display = "block";
    form_3.style.display = "none";

    form_3_btns.style.display = "none";
    form_2_btns.style.display = "flex";

    form_3_progessbar.classList.remove("active");
  });

  form_3_next_btn.addEventListener("click", function () {
    form_4.style.display = "block";
    form_3.style.display = "none";

    form_3_btns.style.display = "none";
    form_3_btns.style.display = "none";

    if ($("#cbSendEmail").is(":checked")) {
      $(".form_4").html(
        '<div class="input_wrap" style="display: flex;justify-content: center;width:120%;"><h2>Kết quả sẽ được gửi qua email!!!</h2></div>'
      );
    } else {
      Caculation();
      // setTimeout(function () {
      //   $(".form_4").html(
      //     '<h2>Hoàn thành!!!</h2><div class="input_wrap" style="display: flex;justify-content: center;"><div class="input_wrap" style="display: flex;justify-content: center;"><label for="file" id="lb-downloadfile"><i class="fa-solid fa-file-arrow-down fa-2xl" style="color: white;margin-right: 10px"></i>Tải file xuống</label></div></div>'
      //   );
      // }, 5000);
    }
    form_4_progessbar.classList.add("active");
  });

  function Caculation() {
    var mamon = $("#dsmon").children("option:selected").val();
    var formDataKey = new FormData();
    formDataKey.append("mamon", mamon);
    console.log(baseURL);
    $.ajax({
      // url: "http://localhost/tinhdiem/index.php/Caculation/start_cal",
      url: baseURL + "/startcal",
      type: "post",
      data: formDataKey,
      processData: false,
      contentType: false,
      success: function () {
        check();
      },
    });
  }

  function check() {
    setTimeout(() => {
      $.ajax({
        url: url_state,
        type: "get",
        success: function ($res) {
          // $response == JSON.parse(res);
          if ($res == "Done") {
            console.log("done");
            $("#form4_title").html("Tải xuống để xem kết quả");
            $(".loader").hide();
            $("#btn_taiXuong").show();
          } else {
            check();
          }
        },
      });
    }, 3000);
  }

  form_4_progessbar.addEventListener("", function () {});

  // btn_done.addEventListener("click", function () {
  // 	modal_wrapper.classList.add("active");
  // })

  // shadow.addEventListener("click", function () {
  // 	modal_wrapper.classList.remove("active");
  // })

  $(".btn-add_md").on("click", function (e) {
    // console.log($('add-files-group'));
    $(".add-files-group").append(
      `<div class="input-group">
                                <input type="text" class="input input-made" placeholder="Định dạng hỗ trợ .xlsx">
                                <input type="file" name="upload_file_key" class="upload_file form-control" placeholder="Enter file">
                                <span class="btn_removeDA"><i style="margin-left: 10px;" class="fa-solid fa-xmark"></i></span>
                            </div>`
    );
  });

  $("body").on("click", ".btn_removeDA", function () {
    let divFileGroup = $(this).closest(".add-files-group")[0];
    console.log(divFileGroup);
    console.log($(this).parent()[0]);
    $(this).closest(".input-group").remove();
    // divFileGroup.remove($(this).parent()[0])
  });

  $(document).on("change", ".upload_file", function (even) {
    let files = this.files;
    let formData = new FormData();
    let maDeValue = $(this).closest(".input-group").find(".input-made").val();
    for (let i = 0; i < files.length; i++) {
      formData.append("file[]", files[i]); // Đưa từng file vào formData với tên là "file[]"
    }
    formData.append("maDe", maDeValue);
    // console.log(maDeValue);
    $.ajax({
      url: baseURL + "/Site/themDe",
      type: "POST",
      data: formData,
      processData: false, // Không xử lý dữ liệu
      contentType: false, // Không đặt header Content-Type
      success: function (res) {
        console.log(res);
        let respon = JSON.parse(res);
        console.log(respon);
        // show_listFiles(respon);
      },
      error: function (xhr, status, error) {
        // Xử lý lỗi (nếu có)
        console.error(error);
      },
    });
  });

  // $(document).on("change", ".upload_file", function (even) {
  //   var fileToUpload = even.target.files[0];
  //   // console.log(fileToUpload);
  //   var mamon = $("#dsmon").children("option:selected").val();
  //   var made = $(this).siblings(".input-made").val();
  //   if (made == "" || made == null) {
  //     alert("Bạn chưa nhập mã đề");
  //     $(this).val("");
  //   } else {
  //     if (fileToUpload != "undefined") {
  //       $(this)
  //         .parents(".input-group")
  //         .append(
  //           '<i class="fa-solid fa-circle-check fa-2xl" style="color: #009e6f;margin-left:10px;"></i>'
  //         );
  //       $(this).hide();
  //       var formDataKey = new FormData();
  //       formDataKey.append("upload_file_key", fileToUpload);
  //       formDataKey.append("made", made);
  //       formDataKey.append("mamon", mamon);
  //       $.ajax({
  //         url: url_themdapan,
  //         type: "post",
  //         data: formDataKey,
  //         processData: false,
  //         contentType: false,
  //         success: function (data) {
  //           data = JSON.parse(data);
  //           console.log(data[0]);
  //           xml = "";
  //           xml +=
  //             '<div class="list-file-dapan"><div class="file-items">' +
  //             data[0] +
  //             '</div><div class="btn-del-dapan"><i class="fa-solid fa-trash delete-dapan" style="color: #eb0000;"></i></div></div>';
  //           $("#list-dapan").append(xml);
  //         },
  //       });
  //     }
  //   }
  //   if (fileToUpload == null) {
  //     alert("Chưa thêm file hoặc sai định dạng");
  //   }
  // });

  $(document)
    .off("click")
    .on("click", ".delete-dapan", function (e) {
      var filename = $(this)
        .parents(".btn-del-dapan")
        .siblings(".file-items")
        .text();
      var currentfile = $(this)
        .parents(".btn-del-dapan")
        .parents(".list-file-dapan");
      console.log(currentfile);
      $.ajax({
        url: baseURL + "/xoadapan",
        type: "post",
        data: {
          namefile: filename,
        },
        success: function (data) {
          currentfile.html("");
        },
      });
    });
  $("#file").on("change", function (event) {
    let files = this.files;
    let formData = new FormData();
    for (let i = 0; i < files.length; i++) {
      formData.append("file[]", files[i]);
    }
    // formData.append("file", files);
    $.ajax({
      url: url_upload_files,
      type: "POST",
      data: formData,
      processData: false, // Không xử lý dữ liệu
      contentType: false, // Không đặt header Content-Type
      success: function (res) {
        console.log(res);
        let respon = JSON.parse(res);
        console.log(respon);
        show_listFiles(respon);
      },
      error: function (xhr, status, error) {
        // Xử lý lỗi (nếu có)
        console.error(error);
      },
    });
  });

  function show_listFiles(res) {
    let items = [];
    for (let i = 0; i < res.length; i++) {
      items.push(
        '<li style="min-width: 300px;" class="list-group-item">' +
          res[i] +
          '<div class="pull-right"><a href="#" data-file="' +
          res[i] +
          '" class="remove_file"><i class="fa-solid fa-xmark"></i></a></div></li>'
      );
    }

    $("#listFiles").html(items.join(""));
    // $('#listFiles').append(`<span>${res[i]}</span><i class="fa-solid fa-xmark"></i>`)
    // $("#listFiles").append(
    // '<li style="min-width: 300px;" class="list-group-item">' +
    //   res[i] +
    //   '<div class="pull-right"><a href="#" data-file="' +
    //   res[i] +
    //   '" class="remove_file"><i class="fa-solid fa-xmark"></i></a></div></li>'
    // );
  }

  $("body").on("click", ".remove_file", function () {
    let li = $(this);
    $.ajax({
      url: url_removePTL,
      type: "post",
      data: { file_to_remove: li.attr("data-file") },
      success: () => {
        $(this).closest("li").remove();
      },
    });
  });

  $("#upload-btn").on("click", function (event) {
    var filesToUpload = inputFile[0].files;
    // event.preventDefault();
    // make sure there is file(s) to upload
    if (filesToUpload.length > 0) {
      // provide the form data
      // that would be sent to sever through ajax
      var formData = new FormData();

      for (var i = 0; i < filesToUpload.length; i++) {
        var file = filesToUpload[i];

        formData.append("file[]", file, file.name);
      }
      z;
      // now upload the file using $.ajax
      $.ajax({
        url: uploadURI,
        type: "post",
        data: formData,
        processData: false,
        contentType: false,
        success: function () {
          listFilesOnServer();
          // alert("Thành công");
        },
        xhr: function () {
          var xhr = new XMLHttpRequest();
          xhr.upload.addEventListener(
            "progress",
            function (event) {
              if (event.lengthComputable) {
                var percentComplete = Math.round(
                  (event.loaded / event.total) * 100
                );
                // console.log(percentComplete);

                $(".progress").show();
                progressBar.css({ width: percentComplete + "%" });
                progressBar.text(percentComplete + "%");
              }
            },
            false
          );

          return xhr;
        },
      });
    }
  });

  $("body").on("click", ".remove-file", function () {
    var me = $(this);

    $.ajax({
      url: uploadURI,
      type: "post",
      data: { file_to_remove: me.attr("data-file") },
      success: function () {
        me.closest("li").remove();
        $(".progress").hide();
        progressBar.text("0%");
        progressBar.css({ width: "0%" });
      },
    });
  });

  function listFilesOnServer() {
    var items = [];
    $.getJSON(uploadURI, function (data) {
      $.each(data, function (index, element) {
        items.push(
          '<li class="list-group-item"><i class="fa-solid fa-file" style="margin-right: 10px;"></i>' +
            element +
            '<div class="pull-right"><a href="#" data-file="' +
            element +
            '" class="remove-file"><i class="fa-solid fa-x" style="color: #ff0000;"></i></a></div>'
        );
      });
      $(".list-group").html("").html(items.join(""));
    });
  }

  $("body").on("change.bs.fileinput", function (e) {
    $(".progress").hide();
    progressBar.text("0%");
    progressBar.css({ width: "0%" });
  });

  $("#add-mamon").on("click", function (e) {
    console.log(window.location.href + "/addMonHoc");
    $.ajax({
      url: window.location.href + "/addMonHoc",
      type: "post",
      data: {
        mamon: $("#mamon").val(),
        tenmon: $("#tenmon").val(),
      },
      success: function () {
        $("#dsmon").append(
          "<option value='" +
            $("#mamon").val() +
            "'>" +
            $("#tenmon").val() +
            " (" +
            $("#mamon").val() +
            ")</option>"
        );
        $("#mamon").val("");
        $("#tenmon").val("");
      },
    });
  });
  $(window).on("scroll", function () {
    if ($(window).scrollTop() > 10) {
      $(".navbar").addClass("active");
    } else {
      $(".navbar").removeClass("active");
    }
  });
});
