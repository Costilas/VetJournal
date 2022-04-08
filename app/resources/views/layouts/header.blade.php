<header>
    <div class="container">
        <div class="header_content">
            <div class="logo header-item">
                <img src="{{asset('img/logo.png')}}" class="logo-img"><span>ZooMedPetVet</span>
            </div>
            <ul class="nav header-item menu">
                <a href="{{route('notes')}}">
                    <li class="nav-item">Главная</li>
                </a>
                <a href="{{route('cards')}}">
                    <li class="nav-item">Картотека</li>
                </a>
                <a href="{{route('visits')}}">
                    <li class="nav-item">Приемы</li>
                </a>
                @if(!empty(auth()->user()->is_admin))
                    <a href="{{route('admin')}}">
                        <li class="nav-item">Управление приложением</li>
                    </a>
                @endif
                @if(auth()->check())
                    <a href="{{route('logout')}}">
                        <li class="nav-item">Выход</li>
                    </a>
                @endif
                <li>Status: {{auth()->check()?'auth('.auth()->user()->name.')':'out'}}</li>
            </ul>
        </div>
    </div>
</header>
