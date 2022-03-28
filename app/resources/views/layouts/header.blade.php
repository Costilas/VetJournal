<header>
    <div class="container">
        <div class="header_content">
            <div class="logo header-item">
                <img src="{{asset('img/logo.png')}}" class="logo-img"><span>ZooMedPetVet</span>
            </div>

            <ul class="nav header-item menu">
                <a href="{{route('home')}}">
                    <li class="nav-item">Главная</li>
                </a>
                <a href="{{route('card.search')}}">
                    <li class="nav-item">Картотека</li>
                </a>
                {{--<a href="{{route('visit.search')}}">
                    <li class="nav-item">Приемы</li>
                </a>--}}
                {{-- <a href="{{route('notes')}}"><li class="nav-item">Заметки</li></a>--}}
            </ul>
        </div>
    </div>
</header>
