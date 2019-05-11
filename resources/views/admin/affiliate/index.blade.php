@extends('admin.layouts.app')

@section('main')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <div class="clearfix mb-2">
                <form action="{{ route('affiliate.index') }}" method="get" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" value="{{ Request::get('userid') }}" name="userid" placeholder="User ID" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" value="{{ Request::get('username') }}" name="username" placeholder="Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" value="{{ Request::get('email') }}" name="email" placeholder="Email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" value="{{ Request::get('phone') }}" name="phone" placeholder="Phone" class="form-control">
                            </div>
                        </div>
                    </div>

                    <hr>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>

                </form>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>UserID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach( $data as $item )
                    <tr>

                        <td>{{ $item->userid }}</td>
                        <td>{{ $item->full_name}}</td>
                        <td>
                            <a href="#">{{ $item->username }}</a>
                        </td>
                        <td>
                            {{ $item->phone }}
                        </td>
                        <td><span class="badge badge-info">{{ config( 'ulu.affiliate_status' )[$item->status] }}</span></td>
                        <td>
                            <a href="{{ route('affiliate.show', $item->id ) }}" class="btn btn-warning btn-xs">View</a>
                            <a href="{{ route('affiliate.edit', $item->id ) }}" class="btn btn-primary btn-xs">Edit</a>
                            <a href="{{ route('admin.affiliate.change.password', [ 'id' => $item->id ] ) }}"
                               class="btn btn-primary btn-xs">Change Password</a>
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



@stop