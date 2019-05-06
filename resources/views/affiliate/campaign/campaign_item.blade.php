<div class="col-md-3 mb-3">
    <div class="card shadow-lg border" style="height: 100%">
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
                        <span class="text-secondary">{{ strtoupper($campaign->merchant->account) }}</span>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-4">Loại: {{ $campaign->type }} </div>
                    <div class="col-8 text-right">Cookies: {{ $campaign->cookie_time }}</div>
                </div>
                <p class="text-right mt-3">
                    @php
                        $isRegCampaign = auth()->user()->isRegisterdCampain( $campaign->id )
                    @endphp
                    @if( !$isRegCampaign )
                        <a href="{{ route('affiliate.campaign.register', $campaign->id ) }}"
                           class="btn-register-campaign btn btn-xs  btn-success">Đăng ký <i class="fa fa-angle-right"></i></a>
                    @elseif( $isRegCampaign->status == 0 )
                        <a href="javascript: void(0)"
                           class="btn btn-xs  btn-info">Chờ duyệt <i class="fa fa-angle-right"></i></a>
                    @endif
                    <a href="{{ route('affiliate.campaign.show', [ 'id' =>  $campaign['id'] ] ) }}"
                       class="btn btn-xs  btn-primary">Chi tiết <i class="fa fa-angle-right"></i> </a>

                </p>
            </div><!--end campaign-item -->
        </div>
    </div>
</div>