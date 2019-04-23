@extends('admin.layouts.app')

@section('main')
    <div class="clearfix mb-3">
        <p class="float-left">
            Edit affiliate
        </p>

    </div>
    @include('admin.partials.messages')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">

        </div>
        <div class="card-footer text-center">
            <a href="{{ route('affiliate.index') }}" class="btn btn-primary float-right">Back</a>
        </div>
    </div>


@stop