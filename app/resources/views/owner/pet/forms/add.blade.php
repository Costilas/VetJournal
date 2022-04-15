<form action="{{route('pet.add')}}" method="POST">
    @csrf
    <div class="row row-cols-1">
        <div class="col-12">
            <h4 class="text-center"><i class="fa-solid fa-paw"></i> Новый питомец:</h4>
        </div>
    </div>
    <div class="row row-cols-auto mt-3 justify-content-center">
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 col-xs-10 mb-lg-3 mb-md-4 mb-sm-5  xs-w-9 xs-mb-3">
            <label for="last_name">Кличка питомца:</label>
            <input type="text" class="form-control @error('pet.pet_name') is-invalid @enderror"
                   name="pet[pet_name]" placeholder="Боня" aria-label="Pet name"
                   value="{{session()->getOldInput('pet.pet_name')}}">
        </div>

        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 col-xs-10 mb-lg-3 mb-md-4 mb-sm-5  xs-w-9 xs-mb-3">
            <label for="birth">Дата рождения питомца:</label>
            <input type="date" class="form-control @error('pet.birth') is-invalid @enderror"
                   name="pet[birth]" aria-label="birth"
                   value="{{session()->getOldInput('pet.birth')}}">
        </div>

        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 col-xs-10 mb-lg-3 mb-md-4 mb-sm-5  xs-w-9 xs-mb-3">
            <label for="pet[kind_id]">Вид питомца:</label>
            <select name="pet[kind_id]" class="form-control @error('pet.kind_id') is-invalid @enderror">
                @foreach($kinds as $kind)
                    <option  @if($kind->id == session()->getOldInput('pet.kind_id')) selected @endif value="{{$kind->id}}" >{{$kind->kind}}</option>
                @endforeach
            </select>
        </div>
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 col-xs-10 mb-lg-3 mb-md-4 mb-sm-5  xs-w-9 xs-mb-3">
            <label for="pet[gender_id]">Пол питомца:</label>
            @foreach($genders as $gender)
                <br><input type="radio" name="pet[gender_id]" @if($gender->id == session()->getOldInput('pet.gender_id')) checked @endif value="{{$gender->id}}"> <i
                    class="bi bi-gender-{{$gender->icon}} @error('pet.gender_id') is-invalid @enderror"></i>  {{$gender->gender}}
            @endforeach
        </div>
    </div>

    <button type="submit" class="btn btn-primary m-3 d-block m-auto"><i class="bi bi-plus-lg"></i> Добавить </button>

    <input name="pet[owner_id]" type="hidden" value="{{$owner->id}}">
</form>
