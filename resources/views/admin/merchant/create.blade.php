@extends('admin.layouts.app')

@section('main')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('merchant.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="logo" class="col-form-label">Logo</label>
                    <input name="logo" class="form-control" type="file" value="{{ old('logo') }}" placeholder="" id="logo">
                </div>
                <div class="form-group">
                    <label for="account" class="col-form-label">Account</label>
                    <input name="account" class="form-control" type="text" value="{{ old('account') }}" placeholder="" id="account">
                </div>
                <div class="form-group">
                    <label for="account_id" class="col-form-label">Account ID</label>
                    <input name="account_id" class="form-control" type="text" value="{{ old('account_id') }}" placeholder="" id="account_id">
                </div>
                <div class="form-group">
                    <label for="email" class="col-form-label">Email</label>
                    <input name="email" class="form-control" type="email" value="{{ old('email') }}" placeholder="Ex: abc@gmail.com" id="email">
                </div>
                <div class="form-group">
                    <label for="password" class="col-form-label">Password</label>
                    <input name="password" class="form-control" type="text" value="{{ old('password') }}" id="password">
                </div>
                <div class="form-group">
                    <label for="terms" class="col-form-label">Terms & conditions</label>
                    <textarea  class="form-control" name="terms" id="terms" cols="30" rows="10">{{ old('terms') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="company_name" class="col-form-label">Company name</label>
                    <input name="company_name" class="form-control" type="text" value="{{ old('company_name') }}"
                           placeholder="" id="company_name">
                </div>
                <div class="form-group">
                    <label for="company_tax_code" class="col-form-label">Company Tax code</label>
                    <input name="company_tax_code" class="form-control" type="text" value="{{ old('company_tax_code') }}"
                           placeholder="" id="company_tax_code">
                </div>
                <div class="form-group">
                    <label for="company_phone" class="col-form-label">Company phone</label>
                    <input name="company_phone" class="form-control" type="text" value="{{ old('company_phone') }}"
                           placeholder="" id="company_phone">
                </div>
                <div class="form-group">
                    <label for="company_address" class="col-form-label">Company address</label>
                    <input name="company_address" class="form-control" type="text" value="{{ old('company_address') }}"
                           placeholder="" id="company_address">
                </div>

                <div class="form-group">
                    <label for="company_website" class="col-form-label">Company website</label>
                    <input name="company_website" class="form-control" type="text" value="{{ old('company_website') }}"
                           placeholder="" id="company_website">
                </div>
                <div class="form-group">
                    <label for="status" class="col-form-label">Status</label>
                    <select name="status" id="" class="form-control">
                        <option {{ ( old('status') ) ? 'selected' : '' }} value="1">Activate</option>
                        <option {{ ( old('status') == 0) ? 'selected' : '' }} value="0">Deactivate</option>
                    </select>
                </div>


                <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
                <a href="{{ route('merchant.index') }}" class="btn btn-primary">Back</a>
            </form>

        </div>

    </div>


@stop