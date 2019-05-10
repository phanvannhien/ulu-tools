@extends('admin.layouts.app')

@section('main')
    <!-- Default box -->
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
                    <label for="link" class="col-form-label">URL Link <span class="text-danger">*</span></label>
                    <input name="link" class="form-control" type="text" value="{{ old('link') }}" placeholder="" id="link">
                </div>
                <div class="form-group">
                    <label for="banner_image" class="col-form-label">Logo</label>
                    <input name="banner_image" class="form-control" type="file" value="{{ old('banner_image' ) }}"
                           placeholder="" id="banner_image">
                </div>
                <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
                <a href="{{ route('campaign_link.index') }}" class="btn btn-primary">Back</a>
            </form>

        </div>

    </div>


@stop