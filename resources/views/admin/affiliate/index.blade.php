@extends('admin.layout')

@section('main')
    <div class="clearfix mb-3">
        <a href="{{ route('affiliate.sync') }}" class="btn btn-primary float-right">Sync to PAP</a>
    </div>
    @include('admin.partials.messages')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td>Status</td>
                        <td>Commission Rate(%)</td>
                    </tr>
                </thead>
                <tbody>
                @foreach( $data as $item )
                    <tr>
                        <td>{{ $item->fullname}}</td>
                        <td>
                            <a href="#">{{ $item->username }}</a> <br/>
                            <a href="{{ route('affiliate.edit', $item->id) }}"><i class="fa fa-edit"></i> Edit</a> |
                        </td>
                        <td>
                            {{ $item->data8 }}
                        </td>
                        <td>
                            {{ $item->rstatus }}
                        </td>
                        <td>
                            {{ $item->commission_rate }}
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