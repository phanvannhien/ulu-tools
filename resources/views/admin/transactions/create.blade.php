@extends('admin.layouts.app')

@section('main')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.transaction.add.convension') }}" 
                method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="affiliate_id">Publisher <span class="text-danger">*</span></label>
                    <select class="select2-affiliate" name="affiliate_id" id="affiliate_id"></select>
                </div>
                <div class="form-group">
                    <label for="campaign_id" class="col-form-label">Campaign <span class="text-danger">*</span></label>
                    <select name="campaign_id" class="form-control" id="campaign_id">
                        @foreach( $campaigns as $campaign )
                            <option value="{{ $campaign->campaign_id }}" {{ old('campaign_id') == $campaign->campaign_id ? 'selected' :'' }}>{{ $campaign->campaign_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="traffic_id" class="col-form-label">TrafficID <span class="text-danger">*</span></label>
                    <input name="visitor_id" class="form-control" type="text" value="" placeholder="" id="traffic_id">
                </div>
                <div class="form-group">
                    <label for="convension_number" class="col-form-label">Convention number <span class="text-danger">*</span></label>
                    <input name="convension_number" class="form-control" type="text" value="{{old('convension_number')}}" id="convension_number">
                </div>
                <div class="form-group">
                    <label for="payout_system" class="col-form-label">Payout system <span class="text-danger">*</span></label>
                    <input name="payout_system" class="form-control" type="text" value="" value="{{old('payout_system')}}"  id="payout_system">
                </div>
                <div class="form-group">
                    <label for="commission_affiliate" class="col-form-label">Commission Affiliate <span class="text-danger">*</span></label>
                    <input name="commission_affiliate" class="form-control" type="text" value="" value="{{old('commission_affiliate')}}" id="commission_affiliate">
                </div>
                <div class="form-group">
                    <label for="">Ngày tháng <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <div class="btn btn-warning">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                        <input id="conversion_created_date" name="created_at" class="form-control" type="text">
                    </div>
                </div>
                <button type="submit" name="action" value="save" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                <a href="{{ route('affiliate_level.index') }}" class="btn btn-primary">Back</a>
            </form>
        </div>
    </div>
@endsection
