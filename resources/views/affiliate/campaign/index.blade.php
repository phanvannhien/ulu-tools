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
            <?php
                $arrKey = $data[0]->rows[0];
                unset($data[0]->rows[0]);
            ?>
            @foreach ($data[0]->rows as $campaign)
                <?php
                    $arrData = array_combine( $arrKey, $campaign  );
                ?>
                <div class="col-md-3 mb-3">
                    <div class="card shadow-md border" style="height: 100%">
                        <div class="card-body">
                            <img class="img-fluid center-block mx-auto d-block " style="max-height: 60px" src="{{ $arrData['logourl'] }}" alt="">
                            <p>{{ $arrData['name'] }} </p>
                            <p>{!! $arrData['description'] !!} </p>
                        </div>
                        <div class="card-footer bg-primary">
                            @if( $arrData['banners'] > 0 )
                            <a href="{{ route('affiliate.campaign.banner', [ 'campaign_id' =>  $arrData['id'] ] ) }}"
                               class="btn btn-rounded btn-light">Quảng bá</a>
                            @else
                                <a href="#"
                                   class="btn btn-rounded btn-light">Không có Banner</a>
                            @endif

                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
@endsection

