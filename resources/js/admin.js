
try {
    //  window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    //require('bootstrap');
} catch (e) {}

const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token.content
        }
    });
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


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
            'Last 7 Days': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
            'Last 30 Days': [moment().subtract(29, 'days').startOf('day'), moment().endOf('day')],
            'This Month': [moment().startOf('month'), moment().endOf('month').endOf('day')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month').endOf('day')]
        }
    }, cb);




});