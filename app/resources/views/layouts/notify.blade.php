<div class="notify w-50 m-auto">
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success text-center m-3">
            {{\Illuminate\Support\Facades\Session::get('success')}}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger text-center m-3">
            @foreach(array_unique($errors->all()) as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif
</div>
