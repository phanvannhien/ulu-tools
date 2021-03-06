@extends('admin.layouts.app')

@section('main')
    <!-- Default box -->
    <h5 class="mb-3">Affiliates in campaign</h5>
    <div class="card">
        <div class="card-body">
            <div class="clearfix mb-3">
       
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Full name</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach( $data->publishers as $item )
                    <tr>
                        <td>{{ $item->affiliate->full_name }}</td>
                        <td>{{ $item->affiliate->email }}</td>
                        <td>{{ $item->affiliate->phone }}</td>
                        <td><a href="{{ route('admin.aff.campaign',[ 'id' => $item->campaign_id, 'aff_id' => $item->affiliate->userid ]) }}">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        
    </div>

@stop