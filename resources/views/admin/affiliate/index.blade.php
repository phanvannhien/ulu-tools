@extends('admin.layouts.app')

@section('main')
    @include('admin.partials.messages')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <div class="clearfix mb-2">
                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-search"><i class="fa fa-filter"></i> Filter</a>
                <a href="{{ route('affiliate.sync') }}" class="btn btn-primary"><i class="fa fa-refresh"></i> Sync to PAP</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>UserID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Commission Rate(%)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach( $data as $item )
                    <tr>

                        <td>{{ $item->userid }}</td>
                        <td>{{ $item->fullname}}</td>
                        <td>
                            <a href="#">{{ $item->username }}</a>
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
                        <td>
                            <a class="btn btn-primary btn-xs" href="{{ route('affiliate.edit', $item->id) }}"><i class="fa fa-edit"></i> Edit commission</a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            <div class="clearfix">
                @if( $data && count($data))
                    <p class="text-right">Showing {{$data->firstItem()}}-{{$data->lastItem()}} of {{$data->total()}} results</p>
                @endif
            </div>
        </div>
    </div>

    <!-- /.box -->
    <div class="d-flex justify-content-center">
        {!! $data->appends(request()->input())->links() !!}
    </div>

    <div class="modal fade" id="modal-search">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="{{ route('affiliate.index') }}" method="get" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title">Search</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" value="{{ Request::get('userid') }}" name="userid" placeholder="User ID" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ Request::get('username') }}" name="username" placeholder="Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ Request::get('email') }}" name="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ Request::get('phone') }}" name="phone" placeholder="Phone" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('affiliate.index') }}" class="btn btn-success"><i class="fa fa-remove"></i> Clear</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@stop