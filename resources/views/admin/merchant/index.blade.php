@extends('admin.layout')

@section('main')


    @csrf
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Email</td>
                        <td>Password</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach( $data as $item )
                    <tr>
                        <td>
                            <a href="#">{{ $item->email }}</a>
                        </td>
                        <td>
                            <a href="#">{{ $item->password }}</a>
                        </td>
                        <td>
                            <form action="">
                                <input type="hidden" name="email" value="{{ $item->email }}">
                                <input type="hidden" name="password" value="{{ $item->password }}">
                                <button class="btn btn-success" type="submit" name="login" value="1">Login</button>
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