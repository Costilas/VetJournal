<div class="card card-body">
    <form action="{{route('owners.store')}}" method="POST">
        @csrf
        <div class="row row-cols-1">
            <div class="col-12">
                <h4 class="text-center"><i class="bi bi-person-plus"></i>{{__('cards.view.create.form.owner.title')}}</h4>
            </div>
        </div>
        <div class="row row-cols-auto mb-3 mt-3 justify-content-center">
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="last_name">{{__('cards.view.create.form.owner.fields.last_name.label')}}</label>
                <input type="text"
                       id="last_name"
                       class="form-control @error('owner.last_name') is-invalid @enderror"
                       name="owner[last_name]"
                       placeholder="{{__('cards.view.create.form.owner.fields.last_name.placeholder')}}"
                       aria-label="last_name"
                       maxlength="30"
                       required
                       value="{{session()->getOldInput('owner.last_name')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="name">{{__('cards.view.create.form.owner.fields.name.label')}}</label>
                <input type="text"
                       id="name"
                       class="form-control @error('owner.name') is-invalid @enderror"
                       name="owner[name]"
                       placeholder="{{__('cards.view.create.form.owner.fields.name.placeholder')}}"
                       aria-label="name"
                       maxlength="30"
                       required
                       value="{{session()->getOldInput('owner.name')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="patronymic">{{__('cards.view.create.form.owner.fields.patronymic.label')}}</label>
                <input type="text"
                       id="patronymic"
                       class="form-control @error('owner.patronymic') is-invalid @enderror"
                       name="owner[patronymic]"
                       placeholder="{{__('cards.view.create.form.owner.fields.patronymic.placeholder')}}"
                       aria-label="patronymic"
                       maxlength="30"
                       required
                       value="{{session()->getOldInput('owner.patronymic')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="phone">{{__('cards.view.create.form.owner.fields.phone.label')}}</label>
                <input type="text" class="form-control @error('owner.phone') is-invalid @enderror"
                       id="phone"
                       name="owner[phone]"
                       placeholder="{{__('cards.view.create.form.owner.fields.phone.placeholder')}}"
                       aria-label="phone"
                       value="{{session()->getOldInput('owner.phone')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="additionalPhone">{{__('cards.view.create.form.owner.fields.additionalPhone.label')}}</label>
                <input type="text"
                       id="additionalPhone"
                       class="form-control @error('owner.additional_phone') is-invalid @enderror"
                       name="owner[additional_phone]"
                       placeholder="{{__('cards.view.create.form.owner.fields.additionalPhone.placeholder')}}"
                       aria-label="additionalPhone"
                       maxlength="20"
                       minlength="5"
                       value="{{session()->getOldInput('owner.additional_phone')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="email">{{__('cards.view.create.form.owner.fields.email.label')}}</label>
                <input type="email"
                       id="email"
                       class="form-control @error('owner.email') is-invalid @enderror"
                       name="owner[email]"
                       placeholder="{{__('cards.view.create.form.owner.fields.email.placeholder')}}"
                       aria-label="email"
                       maxlength="50"
                       minlength="5"
                       value="{{session()->getOldInput('owner.email')}}">
            </div>
            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="address">{{__('cards.view.create.form.owner.fields.address.label')}}</label>
                <input type="text"
                       id="address"
                       class="form-control @error('owner.address') is-invalid @enderror"
                       name="owner[address]"
                       placeholder="{{__('cards.view.create.form.owner.fields.address.placeholder')}}"
                       aria-label="address"
                       maxlength="255"
                       required
                       value="{{session()->getOldInput('owner.address')}}">
            </div>
        </div>
        <div class="row row-cols-1">
            <div class="col-12">
                <h4 class="text-center"><i class="fa-solid fa-paw"></i>{{__('cards.view.create.form.pet.title')}}</h4>
            </div>
        </div>
        <div class="row row-cols-1 mb-3 mt-3 justify-content-center">
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="pet_name">{{__('cards.view.create.form.pet.fields.pet_name.label')}}</label>
                <input type="text"
                       id="pet_name"
                       class="form-control @error('pets.0.pet_name') is-invalid @enderror"
                       name="pets[0][pet_name]"
                       placeholder="{{__('cards.view.create.form.pet.fields.pet_name.placeholder')}}"
                       aria-label="pet_name"
                       maxlength="30"
                       required
                       value="{{session()->getOldInput('pets.0.pet_name')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="birth">{{__('cards.view.create.form.pet.fields.birth.label')}}</label>
                <input type="date"
                       id="birth"
                       class="form-control form @error('pets.0.birth') is-invalid @enderror"
                       name="pets[0][birth]"
                       aria-label="birth"
                       max="{{$dateInputMaxValue}}"
                       required
                       value="{{session()->getOldInput('pets.0.birth')}}">
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="kind">{{__('cards.view.create.form.pet.fields.kind.label')}}</label>
                <select id="kind"
                        name="pets[0][kind_id]"
                        class="form-select @error('pets.0.kind_id') is-invalid @enderror"
                        required>
                    @foreach($kinds as $kind)
                        <option class="mb-sm-5"
                                {{$kind->id == session()->getOldInput("pets.0.kind_id")?'selected':''}}
                                value="{{$kind->id}}">{{$kind->kind}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="gender">{{__('cards.view.create.form.pet.fields.gender.label')}}</label>
                @foreach($genders as $gender)
                    <br><input type="radio"
                               id="gender"
                               class="form-check-input @error("pets.0.gender_id") is-invalid @enderror"
                               name="pets[0][gender_id]"
                               {{$gender->id == session()->getOldInput("pets.0.gender_id")?'checked':''}}
                               value="{{$gender->id}}"
                               required>
                    <i class="bi bi-gender-{{$gender->icon}}"></i>  {{$gender->gender}}
                @endforeach
            </div>
            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="castration">{{__('cards.view.create.form.pet.fields.castration.label')}}</label>
                @foreach($castrationConditions as $key => $condition)
                    <br><input type="radio"
                               id="castration"
                               class="form-check-input @error("pets.0.castration_condition_id") is-invalid @enderror"
                               name="pets[0][castration_condition_id]"
                               {{$condition->id == session()->getOldInput("pets.0.castration_condition_id")?'checked':''}}
                               value="{{$condition->id}}"
                               required>
                    {!!$condition->icon!!} {{$condition->condition}}
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary m-3 d-block m-auto"><i class="bi bi-plus-lg"></i> {{__('cards.view.create.form.buttons.card_create')}} </button>
    </form>
</div>
