@extends('affiliate.layouts.app')

@section('main')
    <div class="container mt-3">
        <div class="breadcrumbs-area clearfix mb-3">
            <ul class="breadcrumbs">
                <li><a href="{{ route('affiliate.dashboard') }}"><i class="ti-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ route('affiliate.campaign') }}"> Chiến dịch</a></li>
                <li><span>{{ $campaign->campaign_name }}</span></li>
            </ul>
        </div>

        <div class="row align-items-stretch">
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="campaign-item">
                            <div class="row ">
                                <div class="col-3">
                                    <figure class="campaign-img">
                                        <img class=" img-fluid center-block mx-auto d-block "
                                             src="{{ $campaign->merchant->getLogo() }}" alt="">
                                    </figure>
                                </div>
                                <div class="col-8">
                                    <span>{{ $campaign->campaign_name }}</span>
                                    <span class="text-secondary text-uppercase">{{ $campaign->merchant->account }}</span>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-4">Loại: {{ $campaign->type }} </div>
                                <div class="col-8 text-right">Cookies: {{ $campaign->cookie_time }}</div>
                            </div>
                            <p class="row">
                                <span class="col-4">Website</span>
                                <span class="col-8 text-right">{{ $campaign->merchant->company_website }}</span>
                            </p>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Tạo link</h5>
                        <hr/>
                        @php
                            $isRegCampaign = auth()->user()->isRegisterdCampain( $campaign->id )
                        @endphp
                        @if( !$isRegCampaign )
                            <a href="{{ route('affiliate.campaign.register', $campaign->id ) }}"
                               class="btn-register-campaign btn btn-xs  btn-success">Đăng ký ngay <i class="fa fa-angle-right"></i></a>

                        @elseif( $isRegCampaign->status == 0 )
                        <div class="alert alert-info">
                            Chiến dịch của bạn đang được duyệt.
                        </div>
                        @else
                        <form>
                            <input type="hidden" name="campaign_id" value="{{ $campaign->campaign_id }}">
                            <div class="form-group">
                                <label for="link">URL đích</label>
                                <input class="form-control" type="text" name="desturl" value="{{ old('desturl') }}">
                            </div>
                            <button class="btn btn-primary get-url" type="button" name="get_url">Nhận Link</button>
                            <div class="end-link mt-3"></div>

                            <div class="wrap-loadding justify-content-center align-items-center" style="display:none">
                                <div role="status" class="spinner-grow text-primary"><span class="sr-only">Loading...</span></div></div>
                        </form>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        {!! $campaign->description !!}
                    </div>
                </div>
            </div>


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
