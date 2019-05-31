@extends('admin.layouts.app')

@section('main')
    <div class="clearfix mb-3">
        <p class="float-left">
            Edit affiliate in campaign
        </p>
        <a href="{{ route('campaign.index') }}" class="btn btn-primary float-right">Back</a>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.aff.campaign.save', ['id' => $data->campaign_id, 'aff_id' => $data->userid ] ) }}" method="post" >
              
                @csrf
                <input name="campaign_id" class="form-control"
                           type="hidden" value="{{ $data->campaign_id }}" placeholder="" id="campaign_id">
                
                <div class="form-group">
                    <label for="aff_name" class="col-form-label">Affiliate name</label>
                    <input name="aff_name" class="form-control" type="text" value="{{  $data->affiliate->full_name  }}"
                            placeholder="" id="aff_name" readonly>
                </div>
               
                <div class="form-group">
                    <label for="campaign_name" class="col-form-label">Campaign name</label>
                    <input name="campaign_name" class="form-control" type="text" value="{{  $data->campaign->campaign_name  }}"
                           placeholder="" id="campaign_name" readonly>
                </div>

                <div class="form-group">
                    <label for="fixed_url" class="col-form-label">Fixed url</label>
                    <input name="fixed_url" class="form-control" type="text" value="{{ old('fixed_url', $data->fixed_url ) }}"
                           placeholder="" id="fixed_url">
                </div>


        
                <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
            </form>

        </div>
        <div class="card-footer text-center">

        </div>
    </div>


@stop