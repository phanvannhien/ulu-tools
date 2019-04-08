@extends('admin.layout')

@section('main')
   
    @include('admin.partials.messages')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                        <thead>
                        <tr>
                            <td>Order ID</td>
                            <td>Affiliate ID</td>
                            <td>Campaign ID</td>
                            <td>Product ID</td>
                            <td>Account ID</td>
                            <td>Commission</td>
                            <td>Total cost</td>
                            <td>Status</td>
                            <td>Data 1 (Visitor ID)</td>
                            <td>Data 2 (Shopee offer type)</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $data as $item )
                            <tr>
                                <td>{{ $item->t_orderid }}</td>
                                <td>{{ $item->userid }}</td>
                                <td>{{ $item->campaignid}}</td>
                                <td>{{ $item->productid}}</td>
                                <td>{{ $item->accountid}}</td>
                                <td>{{ number_format($item->commission) }}</td>
                                <td>{{ number_format($item->totalcost) }}</td>
                                <td>{{ $item->rstatus}}</td>
                                <td>{{ $item->data1}}</td>
                                <td>{{ $item->data2}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
            
        </div>
        <div class="card-footer text-center">
            <div class="clearfix">
                @if( $data && count($data))
                    <p class="text-right">@lang('app.showing') {{$data->firstItem()}}-{{$data->lastItem()}} @lang('app.of') {{$data->total()}}
                        @lang('app.results')</p>
                @endif
            </div>
        </div>
    </div>

    <!-- /.box -->
    <div class="text-center">
        {!! $data->appends(request()->input())->links() !!}
    </div>
@stop