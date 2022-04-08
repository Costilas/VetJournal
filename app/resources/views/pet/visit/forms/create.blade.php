<form action="{{route('visit.create')}}" method="POST">
    @csrf
    <div class="row mb-3 mt-3">
        <div class="col text-center">
            <p>Время/Дата приема: {{session()->getOldInput('visit.visit_date')??date('Y-m-d H:i:s', time())}}</p>
        </div>
    </div>
    <div class="new_visit_info">
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="weight">Вес(kg):</label>
                <input class="form-control w-25 m-auto @error('visit.weight') is-invalid @enderror"
                       type="text"
                       name="visit[weight]"
                       value="{{session()->getOldInput('visit.weight')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="temperature">Температура:</label>
                <input class="form-control w-25 m-auto @error('visit.temperature') is-invalid @enderror"
                       type="text"
                       name="visit[temperature]"
                       value="{{session()->getOldInput('visit.temperature')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="pre_diagnosis">Предварительный диагноз:</label>
                <input class="form-control m-auto w-50 @error('visit.pre_diagnosis') is-invalid @enderror"
                       type="text"
                       name="visit[pre_diagnosis]"
                       value="{{session()->getOldInput('visit.pre_diagnosis')}}">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="visit[visit_info]">Информация о приеме:</label>
                <textarea class="form-control @error('visit.visit_info') is-invalid @enderror"
                          name="visit[visit_info]"
                          style=" height: 500px;">
                  {{session()->getOldInput('visit.visit_info')}}
                </textarea>
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="visit[doctor_id]">Кем проведен прием:</label>
                <select class="w-25 m-auto form-control @error('visit.doctor_id') is-invalid @enderror"
                          name="visit[doctor_id]">
                    @foreach($doctors as $doctor)
                        <option value="{{$doctor->id}}" @if($doctor->id==auth()->user()->id) selected @endif>{{$doctor->doctorName()}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Создать</button>

    <input type="hidden" name="visit[pet_id]" value="{{$pet->id}}">
    <input type="hidden" name="visit[visit_date]" value="{{session()->getOldInput('visit.visit_date')??date('Y-m-d H:i:s', time())}}">
</form>
