@extends('admin.layout')

@section('main')
    @include('admin.partials.messages')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('check.transaction') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Select file Excel File <a href="{{ url('examples/import_transaction.xlsx') }}">Download File Example .xlsx</a></label>
                    <input type="file" class="form-control" class="" name="file">
                </div>

                <button class="btn btn-primary" type="submit" name="submit">Upload</button>
            </form>


        </div>
    </div>

@endsection
