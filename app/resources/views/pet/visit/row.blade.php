<div class="single_visit">
    <p class="card card-body w-50 m-auto">
        Дата: {{$visit->dateFormat()}}
        <br> Вес: {{$visit->weightFormat()}} кг.
        <br> Температура: {{$visit->temperatureFormat()}} &#176;
        <br> Предварительный диагноз: {{$visit->pre_diagnosis}}
        <a class="btn btn-primary m-auto more_info_button" data-bs-toggle="collapse" href="#oldVisit{{$visit->id}}"
           role="button"
           aria-expanded="false" aria-controls="oldVisit{{$visit->id}}">
            Подробнее
        </a>
    </p>
    <div class="collapse" id="oldVisit{{$visit->id}}">
        <div class="card card-body">
            <div class="visit_card_actions d-flex justify-content-end">
                <a class="btn btn-light" href="{{route('visit.edit', ['id'=>$visit->id])}}"><i
                        class="bi bi-pencil-fill"></i></a>
            </div>
            {{$visit->visit_info}}
        </div>
    </div>
</div>
<hr>
