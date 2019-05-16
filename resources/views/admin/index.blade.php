@extends('admin.layouts.app')

@section('main')
    <div class="row align-items-stretch">
        <div class="col-md-3">
            <div class="bg-danger p-3 text-white text-center">
                <p class="text-white mb-2">Affiliate registerd compaigns</p>
                <p class="text-white" style="font-size: 2rem">{{ $countRegisteredCampaign }}</p>
                <hr>
                <p class="text-center"><a class="btn btn-light" href="{{ route('admin.affiliate.registered.campaign') }}">Approved</a></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="bg-success p-3 text-white text-center">
                <p class="text-white mb-2"><a class="text-white" href="{{ route('affiliate.index') }}">Total Affiliates</a></p>
                <p class="text-white" style="font-size: 2rem">{{ $totalAffiliates }}</p>
                <hr>
                <p class="text-center"><a class="btn btn-light" href="{{ route('affiliate.index') }}">View</a></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="bg-success p-3 text-white text-center">
                <p><a class="text-white mb-2" href="{{ route('campaign.index') }}">Total Campaigns Online</a></p>
                <p class="text-white" style="font-size: 2rem">{{ \App\Models\Campaign::where('status',1)->count() }}</p>
                <hr>
                <p class="text-center"><a class="btn btn-light" href="{{ route('campaign.index') }}">View</a></p>
            </div>
        </div>
    </div>
@endsection
