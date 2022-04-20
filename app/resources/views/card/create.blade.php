<div class="card card-body">
    <form action="{{route('card.create')}}" method="POST">
        @csrf
        <div class="row row-cols-1">
            <div class="col-12">
                <h4 class="text-center"><i class="bi bi-person-plus"></i> Владелец:</h4>
            </div>
        </div>
        <div class="row row-cols-auto mb-3 mt-3 justify-content-center">
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="owner[last_name]">Фамилия владельца:</label>
                <input type="text" class="form-control @error('owner.last_name') is-invalid @enderror"
                       name="owner[last_name]" placeholder="Петров" aria-label="owner[last_name]"
                       maxlength="30"
                       required
                       value="{{session()->getOldInput('owner.last_name')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="owner[name]">Имя владельца:</label>
                <input type="text" class="form-control @error('owner.name') is-invalid @enderror"
                       name="owner[name]" placeholder="Иван" aria-label="First name"
                       maxlength="30"
                       required
                       value="{{session()->getOldInput('owner.name')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="owner[patronymic]">Отчество владельца:</label>
                <input type="text" class="form-control @error('owner.patronymic') is-invalid @enderror"
                       name="owner[patronymic]" placeholder="Иванович" aria-label="owner[patronymic]"
                       maxlength="30"
                       required
                       value="{{session()->getOldInput('owner.patronymic')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="owner[phone]">Телефон:</label>
                <input type="text" class="form-control @error('owner.phone') is-invalid @enderror"
                       name="owner[phone]" placeholder="Телефон" aria-label="owner[phone]"
                       required
                       value="{{session()->getOldInput('owner.phone')}}">
            </div>
            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="owner[address]">Адрес владельца(в произвольной форме):</label>
                <input type="text" class="form-control @error('owner.address') is-invalid @enderror"
                       name="owner[address]" placeholder="г.Новомосковск..." aria-label="owner[address]"
                       maxlength="255"
                       required
                       value="{{session()->getOldInput('owner.address')}}">
            </div>
        </div>
        <div class="row row-cols-1">
            <div class="col-12">
                <h4 class="text-center"><i class="fa-solid fa-paw"></i> Питомец:</h4>
            </div>
        </div>
        <div class="row row-cols-1 mb-3 mt-3 justify-content-center">
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="last_name">Кличка питомца:</label>
                <input type="text" class="form-control @error('pet.pet_name') is-invalid @enderror"
                       name="pet[pet_name]" placeholder="Боня" aria-label="Pet name"
                       maxlength="30"
                       required
                       value="{{session()->getOldInput('pet.pet_name')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="birth">Дата рождения питомца:</label>
                <input type="date" class="form-control @error('pet.birth') is-invalid @enderror"
                       name="pet[birth]" aria-label="birth"
                       max="@createDate(today)"
                       required
                       value="{{session()->getOldInput('pet.birth')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="pet[kind_id]">Вид питомца:</label>
                <select name="pet[kind_id]" required
                        class="form-control text-start @error('pet.kind_id') is-invalid @enderror">
                    @foreach($kinds as $kind)
                        <option class="mb-sm-5" @if($kind->id == session()->getOldInput('pet.kind_id')) selected
                                @endif value="{{$kind->id}}">{{$kind->kind}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="pet[gender_id]">Пол питомца:</label>
                @foreach($genders as $gender)
                    <br><input type="radio" required name="pet[gender_id]"
                               @if($gender->id == session()->getOldInput('pet.gender_id')) checked
                               @endif value="{{$gender->id}}"> <i
                        class="bi bi-gender-{{$gender->icon}} @error('pet.gender_id') is-invalid @enderror"></i>  {{$gender->gender}}
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary m-3 d-block m-auto"><i class="bi bi-plus-lg"></i> Создать</button>
    </form>
</div>
