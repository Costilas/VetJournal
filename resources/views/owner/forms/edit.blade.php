<form action="{{route('owner.update', ['owner'=>$owner])}}" method="POST">
    @csrf
    <div class="row row-cols-1">
        <div class="col-12">
            <h4 class="text-center"><i class="bi bi-pencil-fill"></i> Редактировать профиль владельца:</h4>
        </div>
    </div>
    <div class="row row-cols-auto mb-3 mt-3 justify-content-center">
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
            <label for="last_name">Фамилия владельца:</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                   id="last_name"
                   required
                   maxlength="30"
                   name="last_name" placeholder="Петров" aria-label="last_name"
                   value="{{session()->getOldInput('last_name')??$owner->last_name}}">
        </div>
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
            <label for="name">Имя владельца:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name"
                   name="name" placeholder="Иван" aria-label="name"
                   required
                   maxlength="30"
                   value="{{session()->getOldInput('name')??$owner->name}}">
        </div>
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
            <label for="patronymic">Отчество владельца:</label>
            <input type="text" class="form-control @error('patronymic') is-invalid @enderror"
                   id="patronymic"
                   name="patronymic" placeholder="Иванович" aria-label="patronymic"
                   required
                   maxlength="30"
                   value="{{session()->getOldInput('patronymic')??$owner->patronymic}}">
        </div>
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
            <label for="phone">Телефон:</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                   id="phone"
                   name="phone" placeholder="Телефон" aria-label="phone"
                   maxlength="11"
                   minlength="11"
                   value="{{session()->getOldInput('phone')??$owner->phone}}">
        </div>
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
            <label for="additional_phone">Дополнительный телефон:</label>
            <input type="text" class="form-control @error('additional_phone') is-invalid @enderror"
                   id="additional_phone"
                   name="additional_phone" placeholder="Дополнительный телефон" aria-label="additional_phone"
                   maxlength="20"
                   minlength="5"
                   value="{{session()->getOldInput('additional_phone')??$owner->additional_phone}}">
        </div>
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
            <label for="email">Электронная почта:</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror"
                   id="email"
                   name="email" placeholder="example@somemail.com" aria-label="email"
                   maxlength="50"
                   minlength="5"
                   value="{{session()->getOldInput('email')??$owner->email}}">
        </div>
        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
            <label for="address">Адрес владельца(в произвольной форме):</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror"
                   id="address"
                   name="address" placeholder="г.Новомосковск..." aria-label="address"
                   required
                   maxlength="255"
                   value="{{session()->getOldInput('address')??$owner->address}}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary m-3 d-block m-auto"><i class="bi bi-pencil-square"></i> Сохранить
        изменения
    </button>
</form>
