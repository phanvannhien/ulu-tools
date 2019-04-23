@extends('admin.layouts.app')

@section('main')
   
    @include('admin.partials.messages')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <div class="clearfix mb-3">
                <a class="btn btn-success btn-xs" href="{{ route('affiliate_level.create') }}"><i class="fa fa-plus"></i> Create new</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Level name</td>
                        <td>Min total</td>
                        <td>Max total</td>
                        <td>Commission rate(%)</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach( $data as $item )
                    <tr>
                        <td> <span style="color: {{ $item->level_color }}">{{ $item->level_name }}</span></td>
                        <td>{{ number_format($item->total_min) }} đ</td>
                        <td>{{ number_format($item->total_max) }} đ</td>
                        <td>{{ $item->commision_rate }}</td>
                        <td>
                    
                            <a class="btn btn-primary btn-xs" href="{{ route('affiliate_level.edit', $item->id ) }}"><i class="fa fa-edit"></i> Edit</a>
                            @if( $item->is_default )
                            <a class="btn btn-info btn-xs" href="#"><i class="fa fa-check"></i> Is Default</a>
                            @else
                            <a class="btn btn-primary btn-xs" href="{{ route('affiliate_level.set.default', $item->id ) }}"><i class="fa fa-check"></i> Set default</a>
                            @endif
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