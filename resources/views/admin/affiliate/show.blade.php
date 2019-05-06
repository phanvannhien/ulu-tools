@extends('admin.layouts.app')

@section('main')
    <div class="clearfix mb-3">
        <p class="float-left">
            Affiliate: {{ $affiliate->full_name }}
        </p>

    </div>
    @include('admin.partials.messages')
    @include('admin.affiliate.nav')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            @if( $campaigns )
                <table class="table-bordered table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Campaign code</th>
                            <th>Campaign Name</th>
                            <th>Registered date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $campaigns as $campaign )
                        <tr>
                            <td>{{ $campaign->id }}</td>
                            <td>{{ $campaign->campaign_id }}</td>
                            <td>{{ $campaign->campaign_name }}</td>
                            <td>{{ $campaign->created_at }}</td>
                            <td>
                                @if( !$campaign->register_status )
                                    <form action="{{ route('admin.affiliate.campaign.approved', ['affiliate_id' => $affiliate->userid, 'campaign_id' => $campaign->id ]) }}" method="post">
                                        @csrf
                                        <button class="btn btn-warning" type="submit" name="submit" value="approved">Make Approved</button>
                                    </form>
                                @else
                                    <span class="btn btn-success">Is Approved</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @endif
        </div>

    </div>


@stop