<form action="{{route('visit.create')}}" method="POST">
    @csrf
    <div class="row mb-3 mt-3">
        <div class="col text-center">
            <label for="visit_date">Дата приема<br>(месяц/день/год, по умолчанию сегодняшняя дата)</label>
            <input type="date" class="form-control w-25 m-auto"
                   name="visit_date"
                   aria-label="visit_date"
                   value="{{date('Y-m-d')}}">
        </div>
    </div>
    <div class="new_visit_info">
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="weight">Вес(kg):</label>
                <input class="form-control w-25 m-auto" type="number" name="weight" value="{{old('weight')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="temperature">Температура:</label>
                <input class="form-control w-25 m-auto" type="number" name="temperature" value="{{old('temperature')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="pre_diagnosis">Предварительный диагноз:</label>
                <input class="form-control m-auto w-50" type="text" name="pre_diagnosis" value="{{old('pre_diagnosis')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="visit_info">Информация о приеме:</label>
                <textarea class="form-control" name="visit_info" style=" height: 500px;">{{old('pre_diagnosis')}}</textarea>
            </div>
        </div>

    </div>
    <input type="hidden" name="pet_id" value="{{$pet->id}}">
    <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Создать</button>
</form>
