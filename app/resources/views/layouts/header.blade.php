<header>
    <div class="container">
        <div class="header_content">
            <div class="logo header-item">
                <img src="{{asset('img/logo.png')}}" class="logo-img"><span>ZooMedPetVet</span>
            </div>
            <ul class="nav header-item menu">
                Вы вошли как: {{Auth::user()->email}}
                <a class=" btn btn-menu" href="{{route('notes')}}">
                    <li class="nav-item">Заметки</li>
                </a>
                <a class="btn btn-menu" href="{{route('cards')}}">
                    <li class="nav-item">Картотека</li>
                </a>
                <a class="btn btn-menu" href="{{route('visits')}}">
                    <li class="nav-item">Приемы</li>
                </a>
                @if(!empty(Auth::user()->is_admin))
                    <a class="btn btn-menu" href="{{route('admin')}}">
                        <li class="nav-item">Управление</li>
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
</header>
