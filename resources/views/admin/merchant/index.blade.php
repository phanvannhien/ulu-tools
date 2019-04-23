@extends('admin.layouts.app')

@section('main')
    <!-- Default box -->

    <div class="card">
        <div class="card-body">
            <div class="clearfix mb-3">
                <a class="btn btn-success btn-xs" href="{{ route('merchant.create') }}"><i class="fa fa-plus"></i> Create new</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Account</td>
                        <td>Account ID</td>
                        <td>Email</td>
                        <td>Company name</td>
                        <td>Company phone</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach( $data as $item )
                    <tr>
                        <td>{{ $item->account }}</td>
                        <td>{{ $item->account_id }}</td>
                        <td>
                            <a href="#">{{ $item->email }}</a>
                        </td>
                        <td>{{ $item->company_name }}</td>
                        <td>{{ $item->company_phone }}</td>
                        <td>
                            <a href="{{ route('merchant.edit', $item->id) }}"><i class="fa fa-edit"></i> Edit</a>
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