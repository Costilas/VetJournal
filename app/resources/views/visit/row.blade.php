<tr class="align-middle text-center">
    <td>{{$visit->visitDate()}}</td>
    <td>{{$visit->pet->owner->last_name}}</td>
    <td>{{$visit->pet->pet_name}}</td>
    <td>{{$visit->pre_diagnosis}}</td>
    <td>{{$visit->user->doctorName()}}</td>
    <td>
        <a class="btn btn-primary" href="{{route('pet.show', ['pet'=>$visit->pet_id])}}" target="_blank"><i
                class="fa-solid fa-paw"></i> К пациенту</a>
        <a class="btn btn-warning" href="{{route('visit.edit', ['id'=>$visit->id])}}" target="_blank"><i
                class="bi bi-pencil-fill"></i></a>
    </td>
</tr>
