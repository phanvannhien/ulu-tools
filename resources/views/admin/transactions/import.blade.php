@extends('admin.layouts.app')

@section('main')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.transaction.import.save') }}" 
                method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Select file Excel File <a href="{{ url('examples/import_transaction.xlsx') }}">Download File Example .xlsx</a></label>
                    <input type="file" class="form-control" class="" name="file">
                </div>
                <button class="btn btn-primary" type="submit" name="submit">Start import</button>
            </form>
        </div>
    </div>
@endsection
