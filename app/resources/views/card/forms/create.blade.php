<div class="card card-body">
    <form action="{{route('card.store')}}" method="POST">
        @csrf
        <div class="row row-cols-1">
            <div class="col-12">
                <h4 class="text-center"><i class="bi bi-person-plus"></i> Владелец:</h4>
            </div>
        </div>
        <div class="row row-cols-auto mb-3 mt-3 justify-content-center">
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="last_name">Фамилия владельца:</label>
                <input type="text"
                       id="last_name"
                       class="form-control @error('owner.last_name') is-invalid @enderror"
                       name="owner[last_name]"
                       placeholder="Петров"
                       aria-label="owner[last_name]"
                       maxlength="30"
                       required
                       value="{{session()->getOldInput('owner.last_name')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="name">Имя владельца:</label>
                <input type="text"
                       id="name"
                       class="form-control @error('owner.name') is-invalid @enderror"
                       name="owner[name]"
                       placeholder="Иван"
                       aria-label="First name"
                       maxlength="30"
                       required
                       value="{{session()->getOldInput('owner.name')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="patronymic">Отчество владельца:</label>
                <input type="text"
                       id="patronymic"
                       class="form-control @error('owner.patronymic') is-invalid @enderror"
                       name="owner[patronymic]"
                       placeholder="Иванович"
                       aria-label="owner[patronymic]"
                       maxlength="30"
                       required
                       value="{{session()->getOldInput('owner.patronymic')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="phone">Телефон:</label>
                <input type="text" class="form-control @error('owner.phone') is-invalid @enderror"
                       id="phone"
                       name="owner[phone]"
                       placeholder="Телефон"
                       aria-label="owner[phone]"
                       value="{{session()->getOldInput('owner.phone')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="name">Дополнительный телефон:</label>
                <input type="text"
                       id="additionalPhone"
                       class="form-control @error('owner.additional_phone') is-invalid @enderror"
                       name="owner[additional_phone]"
                       placeholder="Дополнительный телефон"
                       aria-label="Дополнительный телефон"
                       maxlength="20"
                       minlength="5"
                       value="{{session()->getOldInput('owner.additional_phone')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="email">Адрес электронной почты:</label>
                <input type="email"
                       id="email"
                       class="form-control @error('owner.email') is-invalid @enderror"
                       name="owner[email]"
                       placeholder="example@somemail.com"
                       aria-label="owner[email]"
                       maxlength="50"
                       minlength="5"
                       value="{{session()->getOldInput('owner.email')}}">
            </div>
            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="address">Адрес владельца(в произвольной форме):</label>
                <input type="text"
                       id="address"
                       class="form-control @error('owner.address') is-invalid @enderror"
                       name="owner[address]"
                       placeholder="г.Новомосковск..."
                       aria-label="owner[address]"
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
                <label for="pet_name">Кличка питомца:</label>
                <input type="text"
                       id="pet_name"
                       class="form-control @error('pet.pet_name') is-invalid @enderror"
                       name="pet[pet_name]"
                       placeholder="Боня"
                       aria-label="Pet name"
                       maxlength="30"
                       required
                       value="{{session()->getOldInput('pet.pet_name')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="birth">Дата рождения питомца:</label>
                <input type="date"
                       id="birth"
                       class="form-control form @error('pet.birth') is-invalid @enderror"
                       name="pet[birth]"
                       aria-label="birth"
                       max="{{$dateInputMaxValue}}"
                       required
                       value="{{session()->getOldInput('pet.birth')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="pet[kind_id]">Вид питомца:</label>
                <select id=""
                        name="pet[kind_id]"
                        class="form-select @error('pet.kind_id') is-invalid @enderror"
                        required>
                    @foreach($kinds as $kind)
                        <option class="mb-sm-5"
                                {{$kind->id == session()->getOldInput('pet.kind_id')?'selected':''}}
                                value="{{$kind->id}}">{{$kind->kind}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="pet[gender_id]">Пол питомца:</label>
                @foreach($genders as $gender)
                    <br><input type="radio"
                               class="form-check-input @error('pet.gender_id') is-invalid @enderror"
                               name="pet[gender_id]"
                               {{$gender->id == session()->getOldInput('pet.gender_id')?'checked':''}}
                               value="{{$gender->id}}"
                               required>
                    <i class="bi bi-gender-{{$gender->icon}}"></i>  {{$gender->gender}}
                @endforeach
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="pet[gender_id]">Кастрация:</label>
                @foreach($castrationConditions as $condition)
                    <br><input type="radio"
                               class="form-check-input @error('pet.gender_id') is-invalid @enderror"
                               name="pet[castration_condition_id]"
                               {{$condition->id == session()->getOldInput('pet.castration_condition_id')?'checked':''}}
                               value="{{$condition->id}}"
                               required>
                    {!!$condition->icon!!} {{$condition->condition}}
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary m-3 d-block m-auto"><i class="bi bi-plus-lg"></i> Создать</button>
    </form>
</div>
