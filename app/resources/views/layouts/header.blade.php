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
                        Вы вошли как: {{Auth::user()->email}}
                    </div>
                    <a class=" btn btn-menu header-mb-3" href="{{route('notes')}}">
                        <li class="nav-item">Заметки</li>
                    </a>
                    <a class="btn btn-menu header-mb-3" href="{{route('cards')}}">
                        <li class="nav-item">Картотека</li>
                    </a>
                    <a class="btn btn-menu header-mb-3" href="{{route('visits')}}">
                        <li class="nav-item">Приемы</li>
                    </a>
                    @if(!empty(Auth::user()->is_admin))
                        <a class="btn btn-menu header-mb-3" href="{{route('admin.users')}}">
                            <li class="nav-item">Сотрудники</li>
                        </a>
                    @endif
                    @if(Auth::check())
                        <a class="btn btn-menu" href="{{route('logout')}}">
                            <li class="nav-item"><i class="bi bi-box-arrow-left"></i></li>
                        </a>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
