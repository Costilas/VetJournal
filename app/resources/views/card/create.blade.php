<div class="card card-body">
    <form action="{{route('card.create')}}" method="POST">
        @csrf
        <h4 class="text-center">Владелец:</h4>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="last_name">Фамилия владельца:</label>
                <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                       name="last_name" placeholder="Петров" aria-label="Last name"
                       value="{{old('last_name')}}">
            </div>
            <div class="col">
                <label for="name">Имя владельца:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" placeholder="Иван" aria-label="First name"
                       value="{{old('name')}}">
            </div>
            <div class="col">
                <label for="patronymic">Отчество владельца:</label>
                <input type="text" class="form-control @error('patronymic') is-invalid @enderror"
                       name="patronymic" placeholder="Иванович" aria-label="Patronymic"
                       value="{{old('patronymic')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="phone">Телефон:</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                       name="phone" placeholder="Телефон" aria-label="Phone"
                       value="{{old('phone')}}">
            </div>
            <div class="col">
                <label for="address">Адрес владельца(в произвольной форме):</label>
                <input type="text" class="form-control @error('pet_name') is-invalid @enderror"
                       name="address" placeholder="г.Новомосковск..." aria-label="Address"
                       value="{{old('pet_name')}}">
            </div>
        </div>
        <h4 class="text-center">Питомец:</h4>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="last_name">Кличка питомца:</label>
                <input type="text" class="form-control @error('pet_name') is-invalid @enderror"
                       name="pet_name" placeholder="Боня" aria-label="Pet name"
                       value="{{old('pet_name')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="last_name">Кличка питомца:</label>
                <input type="date" class="form-control "
                       name="birth"  aria-label="Pet name"
                       value="{{old('birth')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="kind">Вид питомца:</label>
                <select name="kind">
                    @foreach($kinds as $kind)
                        <option value="{{$kind->id}}">{{$kind->kind}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="gender">Пол питомца:</label>
                @foreach($genders as $gender)
                    <br><input type="radio" name="gender" value="{{$gender->id}}"> <i class="bi bi-gender-{{$gender->icon}}"></i>  {{$gender->gender}}
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Создать</button>
    </form>
</div>
