@extends('admin.layouts.app')

@section('main')
    <div class="clearfix mb-3">
        <p class="float-left">
            Affiliates registered campaigns
        </p>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            @if( $data )
                <table class="table-bordered table">
                    <thead>
                    <tr>
                        <th>Affiliate name</th>
                        <th>Affiliate email</th>
                        <th>Affiliate phone</th>
                        <th>Campaign Name</th>
                        <th>Registered date</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )

                        <tr>
                            <td>{{ $item->affiliate->full_name }}</td>
                            <td>{{ $item->affiliate->email }}</td>
                            <td>{{ $item->affiliate->phone }}</td>
                            <td>{{ $item->campaign->campaign_name }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @if( !$item->status )
                                    <form action="{{ route('admin.affiliate.campaign.approved',
                                    ['affiliate_id' => $item->userid, 'campaign_id' => $item->campaign_id ]) }}" method="post">
                                        @csrf
                                        <button class="btn btn-warning" type="submit" name="submit" value="approved">Make Approved</button>
                                    </form>
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