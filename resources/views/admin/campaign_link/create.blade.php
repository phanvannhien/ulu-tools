@extends('admin.layouts.app')

@section('main')
    <!-- Default box -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('campaign_link.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="campaign_id" class="col-form-label">Campaign <span class="text-danger">*</span></label>
                            <select name="campaign_id" class="form-control" id="campaign_id">
                                @foreach( $campaigns as $campaign )
                                    <option {{ old('campaign_id') == $campaign->campaign_id ? 'selected' :'' }}
                                            value="{{ $campaign->campaign_id }}">{{ $campaign->campaign_name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="link_title" class="col-form-label">Link title</label>
                            <input name="link_title" class="form-control" type="text" value="{{ old('link_title') }}" placeholder="" id="link_title">
                        </div>
                        <div class="form-group">
                            <label for="banner_html" class="col-form-label">Description</label>
                            <textarea name="banner_html" id="banner_html" cols="30" rows="3" class="form-control">{{ old('banner_html') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="link" class="col-form-label">URL Link <span class="text-danger">*</span></label>
                            <input name="link" class="form-control" type="text" value="{{ old('link') }}" placeholder="" id="link">
                        </div>

                        <div class="form-group">
 
                            <label for="">Ngày tháng</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <div class="btn">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <input id="reportrange" name="date_time" class="form-control" value="{{ request()->get('date_time') }}" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-form-label">Status</label>
                            <select name="status" id="" class="form-control">
                                <option {{ ( old('status') ) ? 'selected' : '' }} value="1">Activate</option>
                                <option {{ ( old('status') == 0) ? 'selected' : '' }} value="0">Deactivate</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="240_400" class="col-form-label">Banner 240 x 400</label>
                            <input name="banner_240_400" class="form-control" type="file" value="{{ old('banner_240_400' ) }}"
                                   placeholder="" id="240_400">
                        </div>
                        <div class="form-group">
                            <label for="160_600" class="col-form-label">Banner 160 x 600</label>
                            <input name="banner_160_600" class="form-control" type="file" value="{{ old('banner_160_600' ) }}"
                                   placeholder="" id="160_600">
                        </div>
                        <div class="form-group">
                            <label for="320_50" class="col-form-label">Banner 320 x 50</label>
                            <input name="banner_320_50" class="form-control" type="file" value="{{ old('banner_320_50' ) }}"
                                   placeholder="" id="320_50">
                        </div>
                        <div class="form-group">
                            <label for="336_280" class="col-form-label">Banner 336 x 280</label>
                            <input name="banner_336_280" class="form-control" type="file" value="{{ old('banner_336_280' ) }}"
                                   placeholder="" id="336_280">
                        </div>
                        <div class="form-group">
                            <label for="728_90" class="col-form-label">Banner 728 x 90</label>
                            <input name="banner_728_90" class="form-control" type="file" value="{{ old('banner_728_90' ) }}"
                                   placeholder="" id="728_90">
                        </div>
                        <div class="form-group">
                            <label for="300_250" class="col-form-label">Banner 300 x 250</label>
                            <input name="banner_300_250" class="form-control" type="file" value="{{ old('banner_300_250' ) }}"
                                   placeholder="" id="300_250">
                        </div>
                        <div class="form-group">
                            <label for="468_60" class="col-form-label">Banner 468 x 60</label>
                            <input name="banner_468_60" class="form-control" type="file" value="{{ old('banner_468_60' ) }}"
                                   placeholder="" id="468_60">
                        </div>
                        <div class="form-group">
                            <label for="300_600" class="col-form-label">Banner 300 x 600</label>
                            <input name="banner_300_600" class="form-control" type="file" value="{{ old('banner_300_600' ) }}"
                                   placeholder="" id="300_600">
                        </div>



                        <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
                        <a href="{{ route('campaign_link.index') }}" class="btn btn-primary">Back</a>
                    </form>

                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-title">
                    Banner Affiliates
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

@stop