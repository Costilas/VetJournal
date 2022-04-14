<tr class="align-middle text-center">
    <td><strong>{{$pet->pet_name}}</strong></td>
    <td>{{$pet->kind->kind}}</td>
    <td>{{$pet->gender->gender}}</td>
    <td>{{$pet->birthDateFormat()}} ({{$pet->countYears()}} лет)</td>
    <td>
        <a class="btn btn-secondary" href="{{route('pet.show', ['id'=>$pet->id])}}" target="_blank">К питомцу</a>
        {{--<a class="btn btn-secondary" href="{{route('pet.edit', ['id'=>$pet->id])}}">Редактировать</a>--}}
    </td>
</tr>
