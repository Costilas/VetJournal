<tr class="align-middle text-center">
    <td>{{$pet->created_at}}</td>
    <td><strong>{{$pet->pet_name}}</strong></td>
    <td>{{$pet->kind->kind}}</td>
    <td>{{$pet->gender->gender}}</td>
    <td>{{$pet->castration->condition}}</td>
    <td>{{$pet->birthDate('d-m-Y')}} ({{$pet->countYears()}})</td>
    <td>{{$pet->owner->last_name}} ({{$pet->owner->phone ?? $pet->owner->additional_phone . "(доп.)"}})</td>
    <td>
        <a class="btn btn-primary xs-mb-3" href="{{route('pet.show', ['pet'=>$pet])}}"><i class="fa-solid fa-paw"></i> К
            пациенту</a>
    </td>
</tr>
