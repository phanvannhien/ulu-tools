@extends('affiliate.layouts.app')

@section('main')
    <div class="container mt-3">
        <div class="breadcrumbs-area clearfix mb-3">
            <ul class="breadcrumbs">
                <li><a href="{{ route('affiliate.dashboard') }}"><i class="ti-dashboard"></i> Dashboard</a></li>
                <li><span>Data Feed</span></li>
                <li><span>Shopee</span></li>
            </ul>
        </div>

        <div class="alert alert-info">
            Đang cập nhật
        </div>

    </div>
@endsection

@section('footer')
    <script>
        const bitlyToken = "b3c1329e77097b986dcd7e5582140a6ec017ed6c";
        function wrap_shopee_link( baseULUAffUrl, hubUrl, deepUrl, extraUrl, cb ){
            return cb( baseULUAffUrl +'&url=' + encodeURIComponent( hubUrl + '&url=' + encodeURI( decodeURI( deepUrl )) ) );
        }
        $('document').ready(function () {
            $('.get-url').on('click', function (e) {
                e.preventDefault();
                const form = $(this).closest('form');
                const deepUrl = $(form).find("input[name='desturl']").val();
                const baseULUAffUrl = $(form).find("input[name='baseULUAffUrl']").val();
                const hubUrl = $(form).find("input[name='hubUrl']").val();
                const extraUrl =  $(form).find("input[name='extraUrl']").val();

                if( deepUrl == '' ){
                    $(form).find("input[name='desturl']").focus();
                    return false;
                }else{
                    wrap_shopee_link( baseULUAffUrl, hubUrl , deepUrl, extraUrl, function( endUrl ){
                        $.ajax({
                            type: 'get',
                            url: 'https://api-ssl.bitly.com/v3/shorten?access_token='+bitlyToken+'&longUrl='+ encodeURIComponent(endUrl) ,
                            success: function (data) {
                                if(data) {
                                    if (data.status_code == 200){
                                        $(form).find('.end-link').html(data.data.url).addClass('alert alert-info');
                                    }
                                }
                            }
                        });
                    });
                }



            });
        });
    </script>
@endsection
