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
        var stt = $('.ds-mon').length + 1;
        $("#button-action").on('click', function (e) {
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
                    xml += '<td>' + $("#mamon").val() + '</td>';
                    xml += '<td>' + $("#tenmon").val() + '</td>';
                    xml += '<td><div class="action"><div class="btn-details"><i class="fa-solid fa-eye" style="color: #ffffff;"></i></div><div class="btn-fix"><i class="fa-solid fa-wrench" style="color: #ffffff;" data-toggle="modal" data-target="#modal_mon" data-whatever="@mdo" id="fixmon"></i></i></div><div class="btn-delete"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></div></div></td>';
                    xml += '</tr>';
                    $('#list-mon').append(xml);
                    $("#mamon").val('');
                    $("#tenmon").val('');
                }
            });
        })
    });
    $(document).on('click', '.btn-fix', function (e) {
        var mamonfix=$(this).siblings('.idmamon').val();
        var namemonfix=$(this).siblings('.idmamon').attr('name');
        $('#tieudemodal').text('Sửa môn thi');
        $('#mamon').val(mamonfix);
        $('#tenmon').val(namemonfix);
        $.ajax({
            url: baseURL + "/suamon",
            type: 'post',
            data: {
                'mamon': mamonfix,
                'tenmon': namemonfix,
            },
            success: function (e) {
                alert('Sửa thành công');
                
            }
        });
    });
})(jQuery);