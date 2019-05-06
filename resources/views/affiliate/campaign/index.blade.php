@extends('affiliate.layouts.app')
@section('main')
    <div class="container mt-3">
        <div class="breadcrumbs-area clearfix mb-3">
            <ul class="breadcrumbs">
                <li><a href="{{ route('affiliate.dashboard') }}"><i class="ti-dashboard"></i> Dashboard</a></li>
                <li><span>Chiến dịch</span></li>
            </ul>
        </div>


        @if( count( $campaigns ) )
        <div class="row align-items-stretch">
            @foreach ( $campaigns as $campaign )
                @include('affiliate.campaign.campaign_item')
            @endforeach
        </div>
        @else
            <div class="alert alert-info">
                Bạn chưa đăng ký chiến dịch nào
            </div>
        @endif

    </div>
@endsection

