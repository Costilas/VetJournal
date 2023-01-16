<tr>
    <td>{{$visit->visitDate()}}</td>
    <td>{{$visit->weightFormat()}} кг.</td>
    <td>{{$visit->temperatureFormat()}} &#176;</td>
    <td>{{$visit->pre_diagnosis}}</td>
    <td>{{$visit->user->doctorName()}}</td>
    <td>
        <a class="btn btn-primary mb-xxl-0 mb-md-3 xs-mb-3" data-bs-toggle="collapse" href="#oldVisit{{$visit->id}}"
           role="button"
           aria-expanded="false" aria-controls="oldVisit{{$visit->id}}"><i class="bi bi-info-circle"></i>
            Подробнее
        </a>
        <a class="btn btn-warning" href="{{route('visit.edit', ['id'=>$visit->id])}}">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </td>
</tr>
<tr class="collapse bg-light" id="oldVisit{{$visit->id}}">
    <td class="m-0 border-1 visit_table_child" colspan="4">
        <p><strong>Информация о приеме:</strong></p>
        <div>
            {!! $visit->visit_info !!}
        </div>
    </td>
    <td class="m-0 border-1 visit_table_child" colspan="2">
        <p><strong>Проведенное лечение:</strong></p>
        <div>
            {!! $visit->treatment !!}
        </div>
    </td>
</tr>
