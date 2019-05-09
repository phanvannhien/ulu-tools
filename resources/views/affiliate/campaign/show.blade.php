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


                        <form method="post" action="{{ route('affiliate.campaign.create.link', $campaign->campaign_id ) }}">
                            @csrf
                            <input type="hidden" value="{{ $campaign->merchant->account_id }}" name="merchant_id">
                            <div id="result"></div>
                            <div class="form-group">
                                <label for="target_url">URL đích <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="target_url" value="{{ old('target_url') }}">
                            </div>
                            <div class="form-group">
                                <label for="utm_source">UTM source</label>
                                <input class="form-control" type="text" name="utm_source" value="{{ old('utm_source') }}">
                            </div>
                            <div class="form-group">
                                <label for="utm_campaign">UTM campaign</label>
                                <input class="form-control" type="text" name="utm_campaign" value="{{ old('utm_campaign') }}">
                            </div>

                            <div class="form-group">
                                <label for="utm_medium">UTM medium</label>
                                <input class="form-control" type="text" name="utm_medium" value="{{ old('utm_medium') }}">
                            </div>
                            <button id="get-url" class="btn btn-primary" type="button" name="submit">Nhận Link</button>

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

        $('document').ready(function () {
            $('#get-url').on('click', function (e) {
                e.preventDefault();
                const form = $(this).closest('form');

                $.ajax({
                    type: 'POST',
                    url: $(form).attr('action'),
                    dataType: 'json',
                    data: form.serializeArray(),
                    beforeSend: function () {
                        $(form).find('.wrap-loadding').show();
                    },
                    success: function (response) {
                        $(form).find('.wrap-loadding').hide();
                        if( response.success ) {
                            $(form).find('#result').html(response.url).addClass('alert alert-success');
                        }else{
                            for( var err in res.err ){
                                $('#result').append(  res.err[err]+'<br/>' ).addClass('alert alert-danger');
                            }

                        }
                    },
                    error: function(  jqXHR,  textStatus,  errorThrown){
                        $(form).find('.wrap-loadding').hide();
                    }
                });

            });
        });
    </script>
@endsection
