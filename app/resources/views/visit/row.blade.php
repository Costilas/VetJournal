<tr class="align-middle text-center">
    <td>{{$visit->dateFormat()}}</td>
    <td>{{$visit->pet->pet_name}}</td>
    <td>{{$visit->pre_diagnosis}}</td>
    <td>{{$visit->user->doctorName()}}</td>
    <td>
        <a class="btn btn-secondary" href="{{route('pet.show', ['id'=>$visit->pet->id])}}" target="_blank">К питомцу</a>
        <a class="btn btn-secondary" href="{{route('visit.edit', ['id'=>$visit->id])}}" target="_blank">Редактировать</a>
    </td>
</tr>
