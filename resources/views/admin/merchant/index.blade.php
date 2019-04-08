@extends('admin.layout')

@section('main')
   
    @include('admin.partials.messages')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Account</td>
                        <td>Email</td>
                        <td>Password</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach( $data as $item )
                    <tr>
                        <td>{{ $item->account }}</td>
                        <td>
                            <a href="#">{{ $item->email }}</a> <br/>
                            <a href="{{ route('merchant.edit', $item->id) }}"><i class="fa fa-edit"></i> Edit</a> |

                        </td>
                        <td>
                            <a href="#">{{ $item->password }}</a>
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