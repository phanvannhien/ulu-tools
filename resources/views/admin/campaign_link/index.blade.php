@extends('admin.layouts.app')

@section('main')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <div class="clearfix mb-3">
                <a class="btn btn-success btn-xs" href="{{ route('campaign_link.create') }}"><i class="fa fa-plus"></i> Create new</a>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>

                    <td>Campaign</td>
                    <td>Link title</td>
                    <td>Link</td>
                    <td>Datetime</td>
                    <td>Status</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @foreach( $data as $item )
                    <tr>
                        <td>{{ $item->campaign->campaign_name }}</td>

                        <td>{{ $item->link_title }}</td>
                        <td>
                            <div style="width: 300px; overflow: hidden">
                            {{ $item->link }}
                            </div>

                        </td>
                        <td>{{ $item->start_date.' - '.$item->end_date }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="{{ route('campaign_link.edit', $item->id) }}"><i class="fa fa-edit"></i> Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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