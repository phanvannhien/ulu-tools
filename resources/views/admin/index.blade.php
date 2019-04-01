@extends('admin.layout')

@section('main')
    <div class="row align-items-stretch">

    </div>
    @foreach( \App\Models\Merchant::all() as $merchant )
    <div class="col-sm-6 col-md-4">
        <div class="card">
            <div class="card-header">
                {{ $merchant->account }}
            </div>
            <div class="card-body">
                <p>Account: {{ $merchant->email }}</p>
                <hr>
                <form action="">
                    @csrf
                    <input type="hidden" name="email" value="{{ $merchant->email }}">
                    <input type="hidden" name="password" value="{{ $merchant->password }}">
                    <button class="btn btn-success" type="submit" name="login" value="1">Login</button>
                </form>
            </div>

        </div>

    </div>
    @endforeach

@endsection
