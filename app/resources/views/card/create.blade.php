<div class="card card-body">
    <form action="{{route('card.create')}}" method="POST">
        @csrf
        <h4 class="text-center"><i class="bi bi-person-plus"></i> Владелец:</h4>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="owner[last_name]">Фамилия владельца:</label>
                <input type="text" class="form-control @error('owner.last_name') is-invalid @enderror"
                       name="owner[last_name]" placeholder="Петров" aria-label="owner[last_name]"
                       value="{{session()->getOldInput('owner.last_name')}}">
            </div>
            <div class="col">
                <label for="owner[name]">Имя владельца:</label>
                <input type="text" class="form-control @error('owner.name') is-invalid @enderror"
                       name="owner[name]" placeholder="Иван" aria-label="First name"
                       value="{{session()->getOldInput('owner.name')}}">
            </div>
            <div class="col">
                <label for="owner[patronymic]">Отчество владельца:</label>
                <input type="text" class="form-control @error('owner.patronymic') is-invalid @enderror"
                       name="owner[patronymic]" placeholder="Иванович" aria-label="owner[patronymic]"
                       value="{{session()->getOldInput('owner.patronymic')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="owner[phone]">Телефон:</label>
                <input type="text" class="form-control @error('owner.phone') is-invalid @enderror"
                       name="owner[phone]" placeholder="Телефон" aria-label="owner[phone]"
                       value="{{session()->getOldInput('owner.phone')}}">
            </div>
            <div class="col">
                <label for="owner[address]">Адрес владельца(в произвольной форме):</label>
                <input type="text" class="form-control @error('owner.address') is-invalid @enderror"
                       name="owner[address]" placeholder="г.Новомосковск..." aria-label="owner[address]"
                       value="{{session()->getOldInput('owner.address')}}">
            </div>
        </div>
        <h4 class="text-center">Питомец:</h4>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="last_name">Кличка питомца:</label>
                <input type="text" class="form-control @error('pet.pet_name') is-invalid @enderror"
                       name="pet[pet_name]" placeholder="Боня" aria-label="Pet name"
                       value="{{session()->getOldInput('pet.pet_name')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="birth">Дата рождения питомца:</label>
                <input type="date" class="form-control @error('pet.birth') is-invalid @enderror"
                       name="pet[birth]" aria-label="birth"
                       value="{{session()->getOldInput('pet.birth')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="pet[kind_id]">Вид питомца:</label>
                <select name="pet[kind_id]" class="form-control w-25 text-start @error('pet.kind_id') is-invalid @enderror">
                    @foreach($kinds as $kind)
                        <option  @if($kind->id == session()->getOldInput('pet.kind_id')) selected @endif value="{{$kind->id}}" >{{$kind->kind}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="pet[gender_id]">Пол питомца:</label>
                @foreach($genders as $gender)
                    <br><input type="radio" name="pet[gender_id]" @if($gender->id == session()->getOldInput('pet.gender_id')) checked @endif value="{{$gender->id}}"> <i
                        class="bi bi-gender-{{$gender->icon}} @error('pet.gender_id') is-invalid @enderror"></i>  {{$gender->gender}}
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Создать</button>
    </form>
</div>
