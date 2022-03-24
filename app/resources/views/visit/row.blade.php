<div class="single_visit">
    <p class="card card-body w-50 m-auto">
        Дата: {{$visit->dateFormat()}}
        <br> Вес: {{$visit->weight}}
        <br> Температура: {{$visit->temperature}}
        <br> Предварительный диагноз: {{$visit->pre_diagnosis}}
        <a class="btn btn-primary m-auto more_info_button" data-bs-toggle="collapse" href="#oldVisit{{$visit->id}}"
           role="button"
           aria-expanded="false" aria-controls="oldVisit{{$visit->id}}">
            Подробнее
        </a>
    </p>
    <div class="collapse" id="oldVisit{{$visit->id}}">
        <div class="card card-body">
            {{$visit->visit_info}}
        </div>
    </div>
</div>
<hr>
