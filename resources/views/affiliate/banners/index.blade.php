@extends('affiliate.layouts.app')

@section('main')
    <div class="container mt-3">
        <div class="breadcrumbs-area clearfix mb-3">
            <ul class="breadcrumbs">
                <li><a href="{{ route('affiliate.dashboard') }}"><i class="ti-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ route('affiliate.campaign') }}"> Chiến dịch</a></li>
                <li><span>Quảng bá chiến dịch</span></li>
            </ul>
        </div>

        <div class="row align-items-stretch">
            <?php
            $arrKey = $data[0]->rows[0];
            unset($data[0]->rows[0]);
            ?>
            @foreach ($data[0]->rows as $banner)
                <?php
                $arrData = array_combine( $arrKey, $banner  );
                ?>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <h4>{{ $arrData['campaignname'] }}</h4>
                                <p><small>{{ $arrData['campaigndetails'] }}</small></p>
                                <hr>
                                <h5>Tạo link</h5>
                                <form>
                                    <input type="hidden" name="baseULUAffUrl" value="{{ $arrData['bannerclickurl'] }}">
                                    <input type="hidden" name="hubUrl" value="{{ $arrData['destinationurl'] }}">
                                    <input type="hidden" name="extraUrl" value="{{ $arrData['description'] }}">
                                    <div class="form-group">
                                        <label for="link">URL đích</label>
                                        <input class="form-control" type="text" name="desturl" value="{{ old('desturl') }}">
                                    </div>
                                    <button class="btn btn-primary get-url" type="button" name="get_url">Nhận Link</button>
                                    <div class="end-link mt-3"></div>

                                    <div class="wrap-loadding justify-content-center align-items-center" style="display:none">
                                        <div role="status" class="spinner-grow text-primary"><span class="sr-only">Loading...</span></div></div>
                                </form>
                            </div>
                            <div class="col-md-5">
                                <div class="bg-light border p-3 banner-detail-wrap">
                                    <div class="banner-detail" id="{{ $arrData['bannerid'] }}">
                                        <div class="table-responsive">
                                                {!! $dataCampaign[1][1][1] !!}
                                        </div>
                                        
                                    </div>

                                    <p class="text-center mt-3">
                                        <a href="#" class="load-more btn btn-info">Xem thêm <i class="fa fa-angle-down"></i> </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <script>


                    </script>

            @endforeach
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
                    $(form).find('.wrap-loadding').show();

                    wrap_shopee_link( baseULUAffUrl, hubUrl , deepUrl, extraUrl, function( endUrl ){
                        $.ajax({
                            type: 'get',
                            url: 'https://api-ssl.bitly.com/v3/shorten?access_token='+bitlyToken+'&longUrl='+ encodeURIComponent(endUrl) ,
                            success: function (data) {
                                $(form).find('.wrap-loadding').hide();
                                if(data) {
                                    if (data.status_code == 200){
                                        $(form).find('.end-link').html(data.data.url).addClass('alert alert-info');
                                    }
                                }
                            },
                            error: function(  jqXHR,  textStatus,  errorThrown){
                                $(form).find('.wrap-loadding').hide();
                            }
                        });
                    });
                }



            });
        });
    </script>
@endsection
