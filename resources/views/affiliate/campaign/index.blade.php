@extends('affiliate.layouts.app')

@section('main')
    <div class="container mt-3">
        <div class="breadcrumbs-area clearfix mb-3">
            <ul class="breadcrumbs">
                <li><a href="{{ route('affiliate.dashboard') }}"><i class="ti-dashboard"></i> Dashboard</a></li>
                <li><span>Chiến dịch</span></li>
            </ul>
        </div>

        <div class="row align-items-stretch">
            @foreach ($data as $merchant)
                <div class="col-md-3 mb-3">
                    <div class="card shadow-md border" style="height: 100%">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <img class="img-fluid center-block mx-auto d-block "
                                         style="max-height: 60px"
                                         src="{{ $merchant->logo }}" alt="">
                                </div>
                                <div class="col-9">
                                    {{ $merchant-> }}
                                </div>
                            </div>

                            <p>{{ $arrData['name'] }} </p>
                            <p>{!! $arrData['description'] !!} </p>
                        </div>
                        <div class="card-footer bg-primary">
                            <a href="{{ route('affiliate.campaign.banner', [ 'campaign_id' =>  $arrData['id'] ] ) }}"
                               class="btn btn-rounded btn-light">Quảng bá</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

