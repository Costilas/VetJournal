<form action="{{route('owner.update', ['id'=>$owner->id])}}" method="POST">
    @csrf
    <div class="row row-cols-1">
        <div class="col-12">
            <h4 class="text-center"><i class="bi bi-pencil-fill"></i> Редактировать профиль владельца:</h4>
        </div>
    </div>
    <div class="row row-cols-auto mb-3 mt-3 justify-content-center">
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
            <label for="owner[last_name]">Фамилия владельца:</label>
            <input type="text" class="form-control @error('owner.last_name') is-invalid @enderror"
                   name="owner[last_name]" placeholder="Петров" aria-label="owner[last_name]"
                   value="{{session()->getOldInput('owner.last_name')??$owner->last_name}}">
        </div>
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
            <label for="owner[name]">Имя владельца:</label>
            <input type="text" class="form-control @error('owner.name') is-invalid @enderror"
                   name="owner[name]" placeholder="Иван" aria-label="First name"
                   value="{{session()->getOldInput('owner.name')??$owner->name}}">
        </div>
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
            <label for="owner[patronymic]">Отчество владельца:</label>
            <input type="text" class="form-control @error('owner.patronymic') is-invalid @enderror"
                   name="owner[patronymic]" placeholder="Иванович" aria-label="owner[patronymic]"
                   value="{{session()->getOldInput('owner.patronymic')??$owner->patronymic}}">
        </div>
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
            <label for="owner[phone]">Телефон:</label>
            <input type="text" class="form-control @error('owner.phone') is-invalid @enderror"
                   name="owner[phone]" placeholder="Телефон" aria-label="owner[phone]"
                   value="{{session()->getOldInput('owner.phone')??$owner->phone}}">
        </div>
        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
            <label for="owner[address]">Адрес владельца(в произвольной форме):</label>
            <input type="text" class="form-control @error('owner.address') is-invalid @enderror"
                   name="owner[address]" placeholder="г.Новомосковск..." aria-label="owner[address]"
                   value="{{session()->getOldInput('owner.address')??$owner->address}}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary m-3 d-block m-auto"><i class="bi bi-pencil-square"></i> Сохранить изменения</button>
</form>

