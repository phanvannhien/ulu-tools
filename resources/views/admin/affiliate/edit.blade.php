@extends('admin.layout')

@section('main')
    <div class="clearfix mb-3">
        <p class="float-left">
            Edit affiliate
        </p>
        <a href="{{ route('affiliate.index') }}" class="btn btn-primary float-right">Back</a>
    </div>
    @include('admin.partials.messages')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('affiliate.update', $affiliate->id ) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="commission_rate" class="col-form-label">Commission rate</label>
                    <input name="commission_rate" class="form-control" type="text" value="{{ old('commission_rate', $affiliate->commission_rate ) }}" placeholder="" id="commission_rate">
                </div>


                <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
            </form>

        </div>
        <div class="card-footer text-center">

        </div>
    </div>


@stop