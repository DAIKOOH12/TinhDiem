(function ($) {
    "use strict";
    $(function () {
        var header = $(".start-style");
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 10) {
                header.removeClass('start-style').addClass("scroll-on");
            } else {
                header.removeClass("scroll-on").addClass('start-style');
            }
        });
    });

    //Animation
    $(document).ready(function () {
        $('body.hero-anime').removeClass('hero-anime');
        $("#data-table").DataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 25, 100], [5, 10, 20, 100]],
            columnDefs: [
                { targets: [0, 1, 3], className: "text-left" },
            ],
            "language": {
                "sProcessing": "Đang xử lý...",
                "sLengthMenu": "Hiển thị _MENU_ dòng",
                "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                "sInfoPostFix": "",
                "sSearch": "Tìm:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Đầu",
                    "sPrevious": "Trước",
                    "sNext": "Tiếp",
                    "sLast": "Cuối"
                }
            }
        });
    });

    //Menu On Hover

    $('body').on('mouseenter mouseleave', '.nav-item', function (e) {
        if ($(window).width() > 750) {
            var _d = $(e.target).closest('.nav-item'); _d.addClass('show');
            setTimeout(function () {
                _d[_d.is(':hover') ? 'addClass' : 'removeClass']('show');
            }, 1);
        }
    });

    //Switch light/dark

    $("#switch").on('click', function () {
        if ($("body").hasClass("dark")) {
            $("body").removeClass("dark");
            $("#switch").removeClass("switched");
        }
        else {
            $("body").addClass("dark");
            $("#switch").addClass("switched");
        }
    });
    $("#addmon").on("click", function (e) {
        $("#button-action").attr('data-dismiss', 'modal');
        $('#tieudemodal').text('Thêm môn thi');
        $('#mamon').val('');
        $('#tenmon').val('');
        $('#mamon').removeAttr('disabled');
        var stt = $('.ds-mon').length + 1;
        $("#button-action").off('click').on('click', function (e) {
            $.ajax({
                url: baseURL + "/themmon",
                type: 'post',
                data: {
                    'mamon': $("#mamon").val(),
                    'tenmon': $("#tenmon").val(),
                },
                success: function (e) {
                    var xml = "";
                    xml += ' <tr class="ds-mon">';
                    xml += '<th scope="row">' + stt + '</th>';
                    xml += '<td class="idmon">' + $("#mamon").val() + '</td>';
                    xml += '<td class="namemon">' + $("#tenmon").val() + '</td>';
                    xml += '<td><div class="action"><div class="btn-details"><i class="fa-solid fa-eye" style="color: #ffffff;"></i></div><div class="btn-fix"><i class="fa-solid fa-wrench" style="color: #ffffff;" data-toggle="modal" data-target="#modal_mon" data-whatever="@mdo" id="fixmon"></i></i></div><div class="btn-delete"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></div></div></td>';
                    xml += '</tr>';
                    toastr.options.timeOut = 2000; // 1.5s 
                    toastr.success('Thêm môn thành công');
                    $('#list-mon').append(xml);
                    $("#mamon").val('');
                    $("#tenmon").val('');
                },
                error: function (e) {
                    toastr.options.timeOut = 2000; // 1.5s 
                    toastr.error('Mã môn đã tồn tại');
                }
            });
        })
    });

    $(document).on('click', '.btn-fix', function (e) {
        var currentrow = $(this).parents('.action').parents('td').parents('.ds-mon');
        var mamonfix = $(this).parents('.action').parents('td').siblings('.idmon').text();
        var namemonfix = $(this).parents('.action').parents('td').siblings('.namemon').text();
        var stt = $(this).parents('.action').parents('td').siblings('.stt').text();
        $('#tieudemodal').text('Sửa môn thi');
        $('#mamon').attr('disabled', 'disabled');
        $('#mamon').val(mamonfix);
        $('#tenmon').val(namemonfix);
        console.log(mamonfix, namemonfix, stt);
        $("#button-action").off('click').on('click', function (e) {
            var newname = $('#tenmon').val();
            console.log(mamonfix, namemonfix);
            $.ajax({
                url: baseURL + "/suamon",
                type: 'post',
                data: {
                    'mamon': mamonfix,
                    'tenmon': newname,
                },
                success: function (e) {
                    $('#namemon').text(newname);
                    toastr.options.timeOut = 1500; // 1.5s 
                    toastr.info('Cập nhật thành công');
                    currentrow.html('');
                    var xml = "";
                    xml += '<th scope="row">' + stt + '</th>';
                    xml += '<td class="idmon">' + mamonfix + '</td>';
                    xml += '<td class="namemon">' + newname + '</td>';
                    xml += '<td><div class="action"><div class="btn-details"><i class="fa-solid fa-eye" style="color: #ffffff;"></i></div><div class="btn-fix"><i class="fa-solid fa-wrench" style="color: #ffffff;" data-toggle="modal" data-target="#modal_mon" data-whatever="@mdo" id="fixmon"></i></i></div><div class="btn-delete"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></div></div></td>';
                    currentrow.html(xml);
                }
            });
        });
    });
    $(document).on('click', '.btn-delete', function (e) {
        if (confirm('Bạn có chắc muốn xóa môn này?')) {
            var currentrow = $(this).parents('.action').parents('td').parents('.ds-mon');
            var mamonfix = $(this).parents('.action').parents('td').siblings('.idmon').text();
            console.log(mamonfix);
            $.ajax({
                url: baseURL + "/xoamon",
                type: 'post',
                data: {
                    'mamon': mamonfix
                },
                success: function (e) {
                    toastr.options.timeOut = 1500; // 1.5s 
                    toastr.success('Xóa môn thành công');
                }
            });
            currentrow.remove();
        }
        else {
            console.log('Đã hủy');
        }
    });
})(jQuery);