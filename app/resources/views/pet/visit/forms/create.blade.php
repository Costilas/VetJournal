<form action="{{route('visit.create')}}" method="POST">
    @csrf
    <div class="row mb-3 mt-3">
        <div class="col text-center">
            <p>Время/Дата приема: {{date('d-m-Y / H:i')}}</p>
        </div>
    </div>
    <div class="new_visit_info">
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="weight">Вес(kg):</label>
                <input class="form-control w-25 m-auto"
                       type="number"
                       name="visit[weight]"
                       value="{{old('weight')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="temperature">Температура:</label>
                <input class="form-control w-25 m-auto"
                       type="number"
                       name="visit[temperature]"
                       value="{{old('temperature')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="pre_diagnosis">Предварительный диагноз:</label>
                <input class="form-control m-auto w-50"
                       type="text"
                       name="visit[pre_diagnosis]"
                       value="{{old('pre_diagnosis')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="visit_info">Информация о приеме:</label>
                <textarea class="form-control"
                          name="visit[visit_info]"
                          style=" height: 500px;">
                    {{old('pre_diagnosis')}}
                </textarea>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Создать</button>

    <input type="hidden" name="visit[pet_id]" value="{{$pet->id}}">
    <input type="hidden" name="visit[visit_date]" value="{{date('Y-m-d H:i:s', time())}}">
</form>
