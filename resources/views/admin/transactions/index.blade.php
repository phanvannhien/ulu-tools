@extends('admin.layout')

@section('main')
    @include('admin.partials.messages')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('check.transaction') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Select file CSV <a href="">Download File Example</a></label>
                    <input type="file" class="form-control" class="" name="file">
                </div>

                <button class="btn btn-primary" type="submit" name="submit">Upload</button>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Status</th>
                        <th>Commission</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $recordset as $record )
                        <tr>
                            <td>{{ $record->get('orderid') }}</td>
                            <td>{{ $record->get('rstatus') }}</td>
                            <td>{{ $record->get('commission') }}</td>
                        </tr>

                    @endforeach

                </tbody>
            </table>


        </div>
    </div>

@endsection
