@if(\Illuminate\Support\Facades\Session::has('success')||$errors->any())
    <div class="notify w-50 m-auto">
        @if(\Illuminate\Support\Facades\Session::has('success'))
            <div class="alert alert-success text-center">
                {{\Illuminate\Support\Facades\Session::get('success')}}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger text-center">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
    </div>
@endif
