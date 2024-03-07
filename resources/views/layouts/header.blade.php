<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <div class="logo">
                <img src="{{asset('img/logo.png')}}" class="logo-img">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end align-items-center header-pb-3"
                 id="navbarTogglerDemo01">
                <ul class="navbar-nav">
                    <div class="text-center text-light d-flex align-items-center justify-content-center header-mb-3">
                        {{__('header.view.logged_as')}} {{$currentUser->email}}
                    </div>
                    <a class=" btn btn-menu header-mb-3" href="{{route('notes')}}">
                        <li class="nav-item">{{__('header.buttons.notes')}}</li>
                    </a>
                    <a class="btn btn-menu header-mb-3" href="{{route('owners')}}">
                        <li class="nav-item">{{__('header.buttons.cards')}}</li>
                    </a>
                    <a class="btn btn-menu header-mb-3" href="{{route('visits')}}">
                        <li class="nav-item">{{__('header.buttons.visits')}}</li>
                    </a>
                    <a class="btn btn-menu header-mb-3" href="{{route('control')}}">
                        <li class="nav-item">
                            {{__('header.buttons.control')}}
                            @if($possibleErrors)
                                <span class="badge rounded-pill bg-danger">{{$possibleErrors}}</span>
                            @else
                                <span class="badge rounded-pill bg-success">0</span>
                            @endif
                        </li>
                    </a>
                    @if($currentUser->is_admin)
                        <a class="btn btn-menu header-mb-3" href="{{route('admin.users')}}">
                            <li class="nav-item">{{__('header.buttons.employee')}}</li>
                        </a>
                    @endif
                    @if($authenticated)
                        <a class="btn btn-menu" href="{{route('logout')}}">
                            <li class="nav-item">
                                <i class="bi bi-box-arrow-left"></i>
                            </li>
                        </a>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
