<tr class="align-middle text-center">
    <td><strong>{{$pet->pet_name}}</strong></td>
    <td>{{$pet->kind->kind}}</td>
    <td>{{$pet->gender->gender}}</td>
    <td>{{$pet->birthDate()}} ({{$pet->countYears()}})</td>
    <td>
        <a class="btn btn-primary xs-mb-3" href="{{route('pet.show', ['id'=>$pet->id])}}"><i class="fa-solid fa-paw"></i> К
            пациенту</a>
        <a class="btn btn-warning" href="{{route('pet.edit', ['id'=>$pet->id])}}"><i class="bi bi-pencil-fill"></i></a>
    </td>
</tr>
