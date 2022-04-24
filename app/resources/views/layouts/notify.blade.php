@if(\Illuminate\Support\Facades\Session::has('success')||$errors->any())
    <div class="row row-cols-1">
        <div class="col col-xl-6 col-lg-6 col-md-8 col-sm-10 xs-w-9 m-auto">
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success text-center m-3 text-break">
                    {{\Illuminate\Support\Facades\Session::get('success')}}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger text-center m-3 text-break">
                    @foreach(array_unique($errors->all()) as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endif
