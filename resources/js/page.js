
window.moment = require('moment');
require('daterangepicker');
window.toastr = require('toastr');



$(document).ready(function () {

    function cb(start, end) {
        console.log(start);
        $('#reportrange').val(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
    }

    $('#reportrange').daterangepicker({
        locale: {
            format: 'YYYY/MM/DD'
        },
        // startDate: start,
        // endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);


    $('.btn-register-campaign').on('click', function (e) {
        e.preventDefault();
        var that = this;
        $.ajax({
            url: $(this).attr('href'),
            method: 'POST',
            dataType: 'json',
            beforeSend: function () {
                $('#preloader').fadeIn();
            },
            success: function (response) {
                $('#preloader').fadeOut();
                if( response.success ){
                    toastr.success('Đăng ký thành công', 'Ulu');
                    $(that)
                        .attr('href','javascript:void(0)')
                        .attr('class','btn btn-info btn-xs')
                        .off('click')
                        .html('Chờ duyệt <i class="fa fa-angle-right"></i>');
                }else{
                    toastr.error('Có lỗi xảy ra, Vui lòng thử lại', 'Ulu');
                }

            },
            error: function ( response ) {
                $('#preloader').fadeOut();
                toastr.error('Có lỗi xảy ra, Vui lòng thử lại', 'Ulu');

            }
        })
    });


});