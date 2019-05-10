@extends('admin.layouts.app')

@section('main')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('campaign.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="merchant_id" class="col-form-label">Merchant</label>
                    <select name="merchant_id" class="form-control" id="merchant_id">
                        @foreach( \App\Models\Merchant::select('account', 'account_id')->get() as $merchant )
                            <option {{ old('merchant_id') == $merchant->account_id ? 'selected' :'' }} value="{{ $merchant->account_id }}">{{ $merchant->account }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label for="campaign_name" class="col-form-label">Campaign Name</label>
                    <input name="campaign_name" class="form-control" type="text" value="{{ old('campaign_name') }}" placeholder="" id="campaign_name">
                </div>
                <div class="form-group">
                    <label for="commission_rate" class="col-form-label">Commission rate</label>
                    <input name="commission_rate" class="form-control" type="text" value="{{ old('commission_rate') }}" placeholder="" id="commission_rate">
                </div>
                <div class="form-group">
                    <label for="cookie_time" class="col-form-label">Cookie time</label>
                    <input name="cookie_time" class="form-control" type="text" value="{{ old('cookie_time') }}" placeholder="" id="cookie_time">
                </div>

                <div class="form-group">
                    <label for="fixed_url" class="col-form-label">Fixed url</label>
                    <input name="fixed_url" class="form-control" type="text" value="{{ old('fixed_url') }}" placeholder="" id="fixed_url">
                </div>

                <div class="form-group">
                    <label for="type" class="col-form-label">Type</label>
                    <select name="type" class="form-control" id="">
                        @foreach( config('ulu.campaign_type') as $type )
                            <option {{ old('type') == $type? 'selected' :'' }} value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description" class="col-form-label">Descriptions</label>
                    <textarea  class="form-control editor" name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                </div>


                <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
                <a href="{{ route('merchant.index') }}" class="btn btn-primary">Back</a>
            </form>

        </div>

    </div>


@stop