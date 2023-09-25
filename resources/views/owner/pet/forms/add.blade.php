<form action="{{route('owner.attachNewPet', ['id' => $owner->id])}}" method="POST">
    @csrf
    <div class="row row-cols-1">
        <div class="col-12">
            <h4 class="text-center"><i class="fa-solid fa-paw"></i> Добавить нового питомца:</h4>
        </div>
    </div>
    <div class="row row-cols-auto mt-3 justify-content-center text-center">
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 col-xs-10 mb-lg-3 mb-md-4 mb-sm-5  xs-w-9 xs-mb-3">
            <label for="petName">Кличка питомца:</label>
            <input type="text" class="form-control @error('pets.0.pet_name') is-invalid @enderror"
                   id="petName"
                   name="pets[0][pet_name]" placeholder="Боня" aria-label="Pet name"
                   value="{{session()->getOldInput('pets.0.pet_name')}}">
        </div>

        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 col-xs-10 mb-lg-3 mb-md-4 mb-sm-5  xs-w-9 xs-mb-3">
            <label for="birth">Дата рождения питомца:</label>
            <input type="date" class="form-control @error('pets.0.birth') is-invalid @enderror"
                   id="birth"
                   max="{{$dateInputMaxValue}}"
                   name="pets[0][birth]" aria-label="birth"
                   value="{{session()->getOldInput('pets.0.birth')}}">
        </div>

        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 col-xs-10 mb-lg-3 mb-md-4 mb-sm-5  xs-w-9 xs-mb-3">
            <label for="kind">Вид питомца:</label>
            <select name="pets[0][kind_id]" id="kind" class="form-control @error('pets.0.kind_id') is-invalid @enderror">
                @foreach($kinds as $kind)
                    <option @if($kind->id == session()->getOldInput('pets.0.kind_id')) selected
                            @endif value="{{$kind->id}}">{{$kind->kind}}</option>
                @endforeach
            </select>
        </div>
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 col-xs-10 mb-lg-3 mb-md-4 mb-sm-5  xs-w-9 xs-mb-3">
            <label for="gender">Пол питомца:</label>
            @foreach($genders as $gender)
                <br><input type="radio"
                           name="pets[0][gender_id]"
                           id="gender"
                           @if($gender->id == session()->getOldInput('pets.0.gender_id')) checked
                           @endif value="{{$gender->id}}">
                <i class="bi bi-gender-{{$gender->icon}} @error('pets.0.gender_id') is-invalid @enderror"></i> {{$gender->gender}}
            @endforeach
        </div>
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
            <label for="castration">Кастрация:</label>
            @foreach($castrationConditions as $condition)
                <br><input type="radio"
                           id="castration"
                           class="form-check-input @error('pets.0.castration_condition_id') is-invalid @enderror"
                           name="pets[0][castration_condition_id]"
                           {{$condition->id == session()->getOldInput('pets.0.castration_condition_id')?'checked':''}}
                           value="{{$condition->id}}"
                           required>
                {!!$condition->icon!!} {{$condition->condition}}
            @endforeach
        </div>
    </div>

    <button type="submit" class="btn btn-primary m-3 d-block m-auto"><i class="bi bi-plus-lg"></i> Добавить</button>
</form>
