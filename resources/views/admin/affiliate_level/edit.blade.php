@extends('admin.layouts.app')

@section('main')
    <div class="clearfix mb-3">
        <a href="{{ route('affiliate_level.index') }}" class="btn btn-primary btn-xs float-right">Back</a>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('affiliate_level.update', $data->id ) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
            
                    <label for="level_name" class="col-form-label">Level name</label>
                    <input name="level_name" class="form-control" type="text" value="{{ old('level_name', $data->level_name ) }}" placeholder="" id="level_name">
                </div>
                <div class="form-group">
                    <label for="total_min" class="col-form-label">Total min</label>
                    <input name="total_min" class="form-control" type="text" value="{{ old('total_min', $data->total_min) }}" placeholder="" id="total_min">
                </div>
                <div class="form-group">
                    <label for="total_max" class="col-form-label">Total max</label>
                    <input name="total_max" class="form-control" type="text" value="{{ old('total_max', $data->total_max) }}" id="total_max">
                </div>

                <div class="form-group">
                    <label for="level_color" class="col-form-label">Level color</label>
                    <input name="level_color" class="form-control" type="text" value="{{ old('level_color', $data->level_color) }}" id="level_color">
                </div>
                <div class="form-group">
                    <label for="commision_rate" class="col-form-label">Commision rate</label>
                    <input name="commision_rate" class="form-control" type="text" value="{{ old('commision_rate', $data->commision_rate) }}" id="commision_rate">
                </div>
                
                <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
            </form>

        </div>
  
    </div>


@stop