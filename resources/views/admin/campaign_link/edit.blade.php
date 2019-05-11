@extends('admin.layouts.app')

@section('main')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('campaign_link.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="campaign_id" class="col-form-label">Campaign <span class="text-danger">*</span></label>
                    <select name="campaign_id" class="form-control" id="campaign_id">
                        @foreach( $campaigns as $campaign )
                            <option {{ old('campaign_id', $data->campaign_id ) == $campaign->campaign_id ? 'selected' :'' }}
                                    value="{{ $campaign->campaign_id }}">{{ $campaign->campaign_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="link_title" class="col-form-label">Link title</label>
                    <input name="link_title" class="form-control" type="text" value="{{ old('link_title', $data->link_title) }}"
                           placeholder="" id="link_title">
                </div>
                <div class="form-group">
                    <label for="link" class="col-form-label">URL Link <span class="text-danger">*</span></label>
                    <input name="link" class="form-control" type="text" value="{{ old('link', $data->link) }}" placeholder="" id="link">
                </div>

                <div class="form-group">
                    <label for="">Ngày tháng <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <div class="btn btn-warning">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                        <input id="reportrange" name="date_time" class="form-control"
                               value="{{ $data->start_date .' - '. $data->end_date }}" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-form-label">Status</label>
                    <select name="status" id="" class="form-control">
                        <option {{ ( old('status', $data->status) ) ? 'selected' : '' }} value="1">Activate</option>
                        <option {{ ( old('status', $data->status) == 0) ? 'selected' : '' }} value="0">Deactivate</option>
                    </select>
                </div>
                <div class="form-group border p-3">
                    <label for="240_400" class="col-form-label">Banner 240 x 400</label>
                    <input name="banner_240_400" class="form-control" type="file" value="{{ old('banner_240_400', $data->banner_240_400 ) }}"
                           placeholder="" id="240_400">
                    <img src="{{ $data->getBanner( $data->banner_240_400 ) }}" alt="" style="max-width: 120px">
                </div>
                <div class="form-group border p-3">
                    <label for="160_600" class="col-form-label">Banner 160 x 600</label>
                    <input name="banner_160_600" class="form-control" type="file" value="{{ old('banner_160_600', $data->banner_160_600 ) }}"
                           placeholder="" id="160_600">
                    <img src="{{ $data->getBanner( $data->banner_160_600 ) }}" alt="" style="max-width: 120px">
                </div>
                <div class="form-group border p-3">
                    <label for="320_50" class="col-form-label">Banner 320 x 50</label>
                    <input name="banner_320_50" class="form-control" type="file" value="{{ old('banner_320_50', $data->banner_320_50 ) }}"
                           placeholder="" id="320_50">
                    <img src="{{ $data->getBanner( $data->banner_320_50 ) }}" alt="" style="max-width: 120px">
                </div>
                <div class="form-group border p-3">
                    <label for="336_280" class="col-form-label">Banner 336 x 280</label>
                    <input name="banner_336_280" class="form-control" type="file" value="{{ old('banner_336_280', $data->banner_336_280 ) }}"
                           placeholder="" id="336_280">
                    <img src="{{ $data->getBanner( $data->banner_336_280 ) }}" alt="" style="max-width: 120px">
                </div>
                <div class="form-group border p-3">
                    <label for="728_90" class="col-form-label">Banner 728 x 90</label>
                    <input name="banner_728_90" class="form-control" type="file" value="{{ old('banner_728_90', $data->banner_728_90 ) }}"
                           placeholder="" id="728_90">
                    <img src="{{ $data->getBanner( $data->banner_728_90 ) }}" alt="" style="max-width: 120px">
                </div>
                <div class="form-group border p-3">
                    <label for="300_250" class="col-form-label">Banner 300 x 250</label>
                    <input name="banner_300_250" class="form-control" type="file" value="{{ old('banner_300_250', $data->banner_300_250 ) }}"
                           placeholder="" id="300_250">
                    <img src="{{ $data->getBanner( $data->banner_300_250 ) }}" alt="" style="max-width: 120px">
                </div>
                <div class="form-group border p-3">
                    <label for="468_60" class="col-form-label">Banner 468 x 60</label>
                    <input name="banner_468_60" class="form-control" type="file" value="{{ old('banner_468_60', $data->banner_468_60 ) }}"
                           placeholder="" id="468_60">
                    <img src="{{ $data->getBanner( $data->banner_468_60 ) }}" alt="" style="max-width: 120px">
                </div>
                <div class="form-group border p-3">
                    <label for="300_600" class="col-form-label">Banner 300 x 600</label>
                    <input name="banner_300_600" class="form-control" type="file" value="{{ old('banner_300_600', $data->banner_300_600 ) }}"
                           placeholder="" id="300_600">
                    <img src="{{ $data->getBanner( $data->banner_300_600 ) }}" alt="" style="max-width: 120px">
                </div>



                <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
                <a href="{{ route('campaign_link.index') }}" class="btn btn-primary">Back</a>
            </form>

        </div>

    </div>


@stop