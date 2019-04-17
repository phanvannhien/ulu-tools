
@extends('admin.layouts.app')

@section('main')
    @include('admin.partials.messages')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('configuration.store') }}" method="post">
                @csrf
                <div class="d-md-flex">
                    <div class="nav flex-column nav-pills mr-4 mb-3 mb-sm-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Cron jobs </a>

                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            @foreach( $data as $config )
                                <div class="form-group">
                                    <label for="">{{ $config->label }}</label>
                                    @if( $config->type == 'textarea' )
                                        <textarea name="config[{{ $config->name }}]" class="form-control" id="" cols="30" rows="3">{{ $config->value }}</textarea>

                                    @elseif ( $config->type == 'email' )
                                        <input type="email" name="config[{{ $config->name }}]" class="form-control" value="{{ $config->value }}">

                                    @else
                                        <input type="text" name="config[{{ $config->name }}]" class="form-control" value="{{ $config->value }}">

                                    @endif
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" value="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> Save</button>
            </form>
        </div>
    </div>
@stop