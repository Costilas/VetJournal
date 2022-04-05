<form action="{{route('pet.add')}}" method="POST">
    @csrf
    <h4 class="text-center">Новый питомец:</h4>
    <div class="row mb-3 mt-3">
        <div class="col">
            <label for="last_name">Кличка питомца:</label>
            <input type="text" class="w-25 m-auto form-control @error('pet.pet_name') is-invalid @enderror"
                   name="pet[pet_name]" placeholder="Боня" aria-label="Pet name"
                   value="{{session()->getOldInput('pet.pet_name')}}">
        </div>
    </div>
    <div class="row mb-3 mt-3">
        <div class="col">
            <label for="birth">Дата рождения питомца:</label>
            <input type="date" class="w-25 m-auto form-control @error('pet.birth') is-invalid @enderror"
                   name="pet[birth]" aria-label="birth"
                   value="{{session()->getOldInput('pet.birth')}}">
        </div>
    </div>
    <div class="row mb-3 mt-3 w-35 m-auto">
        <div class="col">
            <label for="pet[kind_id]">Вид питомца:</label>
            <select name="pet[kind_id]" class="w-25 m-auto form-control @error('pet.kind_id') is-invalid @enderror">
                @foreach($kinds as $kind)
                    <option  @if($kind->id == session()->getOldInput('pet.kind_id')) selected @endif value="{{$kind->id}}" >{{$kind->kind}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-3 mt-3 w-50 m-auto">
        <div class="col">
            <label for="pet[gender_id]">Пол питомца:</label>
            @foreach($genders as $gender)
                <br><input type="radio" name="pet[gender_id]" @if($gender->id == session()->getOldInput('pet.gender_id')) checked @endif value="{{$gender->id}}"> <i
                    class="bi bi-gender-{{$gender->icon}} @error('pet.gender_id') is-invalid @enderror"></i>  {{$gender->gender}}
            @endforeach
        </div>
    </div>
    <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Добавить </button>

    <input name="pet[owner_id]" type="hidden" value="{{$owner->id}}">
</form>
