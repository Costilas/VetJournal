<tr class="align-middle text-center">
    <td>{{$visit->dateFormat()}}</td>
    <td>{{$visit->weightFormat()}} кг.</td>
    <td>{{$visit->temperatureFormat()}} &#176;</td>
    <td>{{$visit->pre_diagnosis}}</td>
    <td>{{$visit->user->doctorName()}}</td>
    <td>
        <a class="btn btn-primary m-auto more_info_button m-1" data-bs-toggle="collapse" href="#oldVisit{{$visit->id}}"
           role="button"
           aria-expanded="false" aria-controls="oldVisit{{$visit->id}}">
            Подробнее
        </a>
        <a class="btn btn-light m-1" href="{{route('visit.edit', ['id'=>$visit->id])}}">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </td>
</tr>
<tr class="collapse m-3" id="oldVisit{{$visit->id}}">
    <td colspan="6">
        <p><strong> Информация о приеме </strong></p>
        {{$visit->visit_info}}
    </td>
</tr>

