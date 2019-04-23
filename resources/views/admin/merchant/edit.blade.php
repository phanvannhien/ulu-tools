@extends('admin.layouts.app')

@section('main')
    <div class="clearfix mb-3">
        <p class="float-left">
            Edit merchant
        </p>
        <a href="{{ route('merchant.index') }}" class="btn btn-primary float-right">Back</a>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('merchant.update', $merchant->id ) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="account" class="col-form-label">Account</label>
                    <input name="account" class="form-control" type="text" value="{{ old('account', $merchant->account ) }}" placeholder="" id="account">
                </div>

                <div class="form-group">
                    <label for="email" class="col-form-label">Email</label>
                    <input name="email" class="form-control" type="email" value="{{ old('email', $merchant->email) }}" placeholder="Ex: abc@gmail.com" id="email">
                </div>

                <div class="form-group">
                    <label for="has-change-pass" class="col-form-label">
                        <input type="checkbox" id="has-change-pass" name="has_change_password" value="1">
                        Has change password
                    </label>
                    <br>
                    <label for="password" class="col-form-label">Password</label>
                    <input name="password" class="form-control" type="password" value="******" id="password">
                </div>
                <div class="form-group">
                    <label for="terms" class="col-form-label">Terms & conditions</label>
                    <textarea  class="form-control" name="terms" id="terms" cols="30" rows="10">{{ old('terms', $merchant->terms) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="company_name" class="col-form-label">Company name</label>
                    <input name="company_name" class="form-control" type="text" value="{{ old('company_name', $merchant->company_name) }}"
                           placeholder="" id="company_name">
                </div>
                <div class="form-group">
                    <label for="company_tax_code" class="col-form-label">Company Tax code</label>
                    <input name="company_tax_code" class="form-control" type="text" value="{{ old('company_tax_code', $merchant->company_tax_code) }}"
                           placeholder="" id="company_tax_code">
                </div>
                <div class="form-group">
                    <label for="company_phone" class="col-form-label">Company phone</label>
                    <input name="company_phone" class="form-control" type="text" value="{{ old('company_phone', $merchant->company_phone) }}"
                           placeholder="" id="company_phone">
                </div>
                <div class="form-group">
                    <label for="company_address" class="col-form-label">Company address</label>
                    <input name="company_address" class="form-control" type="text" value="{{ old('company_address', $merchant->company_address) }}"
                           placeholder="" id="company_address">
                </div>

                <div class="form-group">
                    <label for="company_website" class="col-form-label">Company website</label>
                    <input name="company_website" class="form-control" type="text" value="{{ old('company_website', $merchant->company_website) }}"
                           placeholder="" id="company_website">
                </div>
                <div class="form-group">
                    <label for="status" class="col-form-label">Status</label>
                    <select name="status" id="" class="form-control">
                        <option {{ ( old('status', $merchant->status) ) ? 'selected' : '' }} value="1">Activate</option>
                        <option {{ ( old('status', $merchant->status) == 0) ? 'selected' : '' }} value="0">Deactivate</option>
                    </select>
                </div>

                <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
            </form>

        </div>
        <div class="card-footer text-center">

        </div>
    </div>


@stop