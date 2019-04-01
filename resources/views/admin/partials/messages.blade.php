@if (count($errors) > 0)
    <div class="alert alert-warning alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <ul class="m-0" style="">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{ session('status') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{ session('warning') }}
    </div>
@endif