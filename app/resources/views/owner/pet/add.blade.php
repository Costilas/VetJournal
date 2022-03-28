
<form action="{{route('pet.add')}}" method="POST">
    @csrf
    <h4 class="text-center">Новый питомец:</h4>
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
            <label for="birth">Дата рождения питомца:</label>
            <input type="date" class="form-control "
                   name="birth" aria-label="birth"
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
                <br><input type="radio" name="gender" value="{{$gender->id}}"> <i
                    class="bi bi-gender-{{$gender->icon}}"></i>  {{$gender->gender}}
            @endforeach
        </div>
    </div>
    <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Добавить </button>

    <input name="owner_id" type="hidden" value="{{$owner->id}}">
</form>


