@if(\Illuminate\Support\Facades\Session::has('success')||$errors->any())
    <div class="row row-cols-1">
        <div class="col col-xl-10 col-lg-10 col-md-8 col-sm-10 xs-w-9 m-auto">
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success text-center m-3 text-break">
                    <i class="bi bi-check-circle-fill success display-2"></i>
                    <p>{{\Illuminate\Support\Facades\Session::get('success')}}</p>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger text-center m-3 text-break">
                    <i class="bi bi-x-circle-fill danger display-2"></i>
                    @foreach(array_unique($errors->all()) as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endif
