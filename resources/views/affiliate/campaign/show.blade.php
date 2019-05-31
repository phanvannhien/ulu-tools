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

                        <hr>

                        <a href="#modal-primacy" data-toggle="modal" class="btn btn-info btn-block">
                            Xem chính sách hoa hồng
                        </a>

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
                              
                                @if( $campaign->fixed_url != ''  )
                                    <input class="form-control" readonly type="text" name="target_url" value="{{  $campaign->fixed_url }}">
                                @elseif($isRegCampaign->fixed_url != '')
                                    <input class="form-control" readonly type="text" name="target_url" value="{{  $isRegCampaign->fixed_url }}">
                                @else
                                    <input class="form-control" type="text" name="target_url" value="{{ old('target_url') }}">
                                @endif
                            </div>

                            <p class="mb-3">
                                <strong><a class=""
                                   data-toggle="collapse"
                                   href="#collapse-more-params" role="button"
                                   aria-expanded="false" aria-controls="collapse-more-params">
                                    Thông tin thêm <i class="fa fa-angle-down"></i>
                                </a></strong>
                            </p>

                            <div id="collapse-more-params" class="collapse">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="utm_source">Nguồn chiến dịch</label>
                                            <input class="form-control" type="text" name="utm_source" value="{{ old('utm_source') }}"
                                                   placeholder="VD: facebook / google ...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="utm_campaign">Tên chiến dịch</label>
                                            <input class="form-control" type="text" name="utm_campaign" value="{{ old('utm_campaign') }}"
                                                   placeholder="VD: Tên sản phẩm, chương trình, sự kiện">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="aff_sub1">Cách tiếp thị</label>
                                    <input class="form-control" type="text" name="aff_sub1" value="{{ old('aff_sub1') }}"
                                           placeholder="VD: Email / CPC / Banner">
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="aff_sub2">Affiliate cấp 1</label>
                                            <input class="form-control" type="text" name="aff_sub2" value="{{ old('aff_sub2') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="utm_medium">Affiliate cấp 2</label>
                                            <input class="form-control" type="text" name="utm_medium" value="{{ old('utm_medium') }}">
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <button id="get-url" class="btn btn-primary" type="button" name="submit">Nhận Link</button>

                            <div class="wrap-loadding justify-content-center align-items-center" style="display:none">
                                <div role="status" class="spinner-grow text-primary"><span class="sr-only">Loading...</span></div></div>
                        </form>
                        @endif
                    </div>
                </div>


            </div>
        </div>

        <div class="card">
            <div class="card-header text-uppercase">Link đã tạo trong chiến dịch</div>
            <div class="card-body">
                <div id="table-links" class="table-responsive">

                </div>
            </div>
        </div>

    </div>
    <div id="modal-primacy" class="modal fade bd-example-modal-lg modal-xl">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chính sách hoa hồng chiến dịch: {{ $campaign->campaign_name }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    {!! $campaign->description !!}</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-primacy" class="modal">
        <div class="modal-body">
            {!! $campaign->description !!}
        </div>
    </div>
@endsection

@section('footer')
    <script>

        function getLinkHistory(params, element ){
            $.ajax({
                url: params.url,
                dataType: 'json',
                method: params.method,
                data: params.data,
                beforeSend: function(){

                },
                success: function( response ){
                    if( response.success ){
                        $(element).html( response.html )
                    }else{
                        toastr.error( response.message, 'Ulu' )
                    }
                }
            })
        }

        $('document').ready(function () {
            getLinkHistory({
                method: 'GET',
                url: '{{ route('ajax.get.links',$campaign->campaign_id ) }}',
                data: {
                    page: 1,
                    per_page: 50,
                }
            }, '#table-links');

            $('#table-links').on('click', 'a.page-link', function (e) {
                e.preventDefault();
                getLinkHistory({
                    method: 'GET',
                    url: $(this).attr('href') ,
                    data: {
                        per_page: 50,
                    }
                }, '#table-links');
            });


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
                            for( var err in response.err ){
                                $('#result').append(  response.err[err]+'<br/>' ).addClass('alert alert-danger');
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
