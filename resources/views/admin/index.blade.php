@extends('admin.layout')

@section('main')
    @include('admin.partials.messages')
    <div class="row align-items-stretch">
        @foreach( \App\Models\Merchant::all() as $merchant )
            <div class="col-sm-6 col-md-4">
                <div class="card ">
                    <div class="card-header {{ session()->get('user')['email'] == $merchant->email ? 'bg-success' : '' }}">
                        {{ $merchant->account }}
                    </div>
                    <div class="card-body">
                        <p>Account: {{ $merchant->email }}</p>
                        <hr>
                        <form action="{{ route('merchant.login') }}" method="post">
                            @csrf
                            <input type="hidden" name="email" value="{{ $merchant->email }}">
                            <input type="hidden" name="password" value="{{ $merchant->password }}">
                            <button class="btn btn-success" type="submit" name="login" value="1">Login</button>
                        </form>
                    </div>

                </div>

            </div>
        @endforeach
    </div>


@endsection
