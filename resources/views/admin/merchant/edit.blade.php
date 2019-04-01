@extends('admin.layout')

@section('main')
    <div class="clearfix mb-3">
        <p class="float-left">
            Edit merchant
        </p>
        <a href="{{ route('merchant.index') }}" class="btn btn-primary float-right">Back</a>
    </div>
    @include('admin.partials.messages')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('merchant.update', $merchant->id ) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="account" class="col-form-label">Account</label>
                    <input name="account" class="form-control" type="text" value="{{ old('account', $merchant->account ) }}" placeholder="Lazada" id="account">
                </div>
                <div class="form-group">
                    <label for="email" class="col-form-label">Email</label>
                    <input name="email" class="form-control" type="email" value="{{ old('email', $merchant->email ) }}" placeholder="Ex: abc@gmail.com" id="email">
                </div>
                <div class="form-group">
                    <label for="password" class="col-form-label">Password</label>
                    <input name="password" class="form-control" type="text" value="{{ old('password', $merchant->password ) }}" id="password">
                </div>
                <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
            </form>

        </div>
        <div class="card-footer text-center">

        </div>
    </div>


@stop