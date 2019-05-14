
window.moment = require('moment');
require('daterangepicker');
window.toastr = require('toastr');

require('select2')


$(document).ready(function () {

    $('.select2-affiliate').select2({
        theme: 'bootstrap4',
        width: '100%',
        minimumInputLength: 3,
        placeholder: 'Search name',
        ajax: {

            url: ajax.get_affiliate ,
            dataType: 'json',
            delay: 500,
            data: function (params) {
                if ( params.term == '' )
                    return false;
                var query = {
                    search: params.term
                }

                // Query parameters will be ?search=[term]&type=public

                return query;
            },
            processResults: function (data) {
                // Tranforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data
                };
            }
        }
    });

    function cb(start, end) {
        console.log(start);
        $('#reportrange').val(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
    }

    $('#reportrange').daterangepicker({
        locale: {
            format: 'YYYY/MM/DD HH:mm:ss'
        },
        // startDate: start,
        // endDate: end,
        timePicker: true,
        timePicker24Hour: true,
        ranges: {
            'Today': [moment().startOf('day'), moment().endOf('day')],
            'Yesterday': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
            'Last 7 Days': [moment().subtract(6, 'days').startOf('day'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days').startOf('day'), moment()],
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