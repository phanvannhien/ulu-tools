@extends('admin.layouts.app')

@section('main')
    <!-- Default box -->
    <h5 class="mb-3">Các banners chiến dịch</h5>
    <div class="card">
        <div class="card-body">
            <div class="clearfix mb-3">
                <a class="btn btn-success btn-xs" href="{{ route('campaign_link.create') }}"><i class="fa fa-plus"></i> Create new</a>
            </div>
            <div class="alert alert-warning">
                Lưu ý: Xoá banner sẽ đồng thời xoá hết Publisher trong banners.
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
                <?php
                    $start = \Carbon\Carbon::parse($item->start_date);
                    $end = \Carbon\Carbon::parse($item->end_date);
                    $now = \Carbon\Carbon::now();
                    $class = '';
                    if( $now->gte( $start )  && $now->lte( $end ) ){
                        $class = 'bg-success';
                    }else{
                        $class = 'bg-warning';
                    }
                    
                ?>
                    <tr class="{{ $class }}">
                        <td>{{ $item->campaign->campaign_name }}</td>

                        <td>{{ $item->link_title }}</td>
                        <td>
                            <div style="width: 300px; overflow: hidden">
                            {{ $item->link }}
                            </div>

                        </td>
                        <td>{{ $item->start_date.' - '.$item->end_date }}</td>
                        <td><span class="badge badge-info">{{ config('ulu.status')[$item->status] }}</span> </td>
                        <td>
                            
                            <a class="btn btn-success btn-xs" href="{{ route('campaign_link.edit', $item->id) }}"><i class="fa fa-edit"></i> Edit</a>
                            <form action="{{ route('campaign_link.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                    Remove
                                </button>
                            </form>
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