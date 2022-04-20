<div class="col-lg-10 m-auto">
    <div class="col-12 text-center">
        <p>Время/Дата
            приема: {{session()->getOldInput('visit.visit_date')??now()->format('d-m-Y / H:i')}}
        </p>
    </div>
    <form action="{{route('visit.create')}}" method="POST">
        @csrf
        <div class="row row-cols-auto justify-content-center">
            <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="weight">Вес(kg):</label>
                <input class="form-control @error('visit.weight') is-invalid @enderror"
                       type="text"
                       name="visit[weight]"
                       required
                       value="{{session()->getOldInput('visit.weight')}}">
            </div>
            <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="temperature">Температура:</label>
                <input class="form-control @error('visit.temperature') is-invalid @enderror"
                       type="text"
                       name="visit[temperature]"
                       required
                       value="{{session()->getOldInput('visit.temperature')}}">
            </div>
            <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="pre_diagnosis">Предварительный диагноз:</label>
                <input class="form-control @error('visit.pre_diagnosis') is-invalid @enderror"
                       type="text"
                       name="visit[pre_diagnosis]"
                       required
                       maxlength="60"
                       value="{{session()->getOldInput('visit.pre_diagnosis')}}">
            </div>
            <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="visit[doctor_id]">Кем проведен прием:</label>
                <select class="form-control @error('visit.user_id') is-invalid @enderror"
                        name="visit[user_id]"
                        required>
                    @foreach($doctors as $doctor)
                        <option value="{{$doctor->id}}"
                                @if($doctor->id==auth()->user()->id) selected @endif>{{$doctor->doctorName()}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                <label for="visit[visit_info]">Информация о приеме:</label>
                <textarea class="form-control @error('visit.visit_info') is-invalid @enderror"
                          name="visit[visit_info]"
                          required
                          style="height: 150px;">{{session()->getOldInput('visit.visit_info')}}</textarea>
            </div>

            <input type="hidden" name="visit[pet_id]" value="{{$pet->id}}">
            <input type="hidden" name="visit[visit_date]"
                   value="{{session()->getOldInput('visit.visit_date')??date('Y-m-d H:i:s', time())}}">
        </div>

        <button type="submit" class="btn btn-primary m-3 d-block m-auto"><i class="bi bi-plus-lg"></i> Создать</button>
    </form>
</div>
