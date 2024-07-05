$(document).ready(function () {
    // $(".active-btn").prop('checked', true);
    // console.log($(".active-btn").length);
    for (let i = 0; i < $(".active-btn").length; i++) {
        var currentstate = $(".active-btn").eq(i).attr('value');
        // console.log(currentstate);
        if (currentstate == "active") {
            $(".active-btn").eq(i).prop('checked', true);
        }
    }
    $(".active-btn").on('change', function (e) {
        console.log($(this).is(":checked"));
        var idde = $(this).parents('.switch').parents('td').siblings('.idde').text();
        // console.log(idde);
        if ($(this).is(":checked")) {
            $.ajax({
                url: baseURL + "/changestate",
                type: 'post',
                data: {
                    'idde': idde,
                    'state': "active"
                },
                success: function (data) {
                    toastr.options.timeOut = 2000; // 1.5s 
                    toastr.success('Thay đổi trạng thái thành công!');
                }
            });
        }
        else {
            $.ajax({
                url: baseURL + "/changestate",
                type: 'post',
                data: {
                    'idde': idde,
                    'state': "inactive"
                },
                success: function (data) {
                    toastr.options.timeOut = 2000; // 1.5s 
                    toastr.success('Thay đổi trạng thái thành công!');
                }
            });
        }
    })
});