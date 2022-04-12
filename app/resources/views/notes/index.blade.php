@extends('layouts.body.app.layout')

@section('title') VetJournal::Заметки @endsection

@section('content')
    <div class="note_wrapper">
        <div class="note create_note_status">
            <form method="POST" action="{{route('note.create')}}">
                @csrf
                <select class="form-control w-75" name="status_id" >
                    @foreach($statuses as $status)
                        <option @if(session()->getOldInput('status_id')===$status->id) selected @endif value="{{$status->id}}">{{$status->name}}</option>
                    @endforeach
                </select>
                <input class="form-control w-75" type="text" name="theme" placeholder="Тема заметки" value="{{session()->getOldInput('theme')}}">
                <textarea class="form-control" name="body" placeholder="Текст заметки">{{session()->getOldInput('body')}}</textarea>
                <button class="btn" type="submit"><i class="bi bi-plus-lg note_icon"></i></button>
            </form>
        </div>
        @if(!empty($notes))
            @foreach($notes as $note)
                <div class="note note_item {{$note->status->class_name}}_status">
                    <p class="date">{{$note->dateFormat()}}</p>
                    <p class="status">Важность: {{$note->status->name}}</p>
                    <h5 class="theme">{{$note->theme}}</h5>
                    <p class="body">{{$note->body}}</p>
                    <a class="btn" href="{{route('note.delete', ['id'=>$note->id])}}"><i class="bi bi-x-lg note_icon"></i></a>
                </div>
            @endforeach
        @endif
    </div>
@endsection
