@extends('layouts.body.app.layout')

@section('title') VetJournal::Заметки @endsection

@section('content')
    <div class="row row-cols-1 mt-5 note_wrapper">
        <div class="col col-xl-3 col-lg-4 col-md-6 col-sm-9 mb-4 mb-5 xs_input xs_note">
            <form class="note flex_column_parameters" method="POST" action="{{route('note.create')}}">
                @csrf
                <select class="form-control" name="status_id">
                    @foreach($statuses as $status)
                        <option @if(session()->getOldInput('status_id')===$status->id) selected @endif value="{{$status->id}}">{{$status->name}}</option>
                    @endforeach
                </select>
                <input class="form-control" type="text" name="theme" placeholder="Тема заметки" value="{{session()->getOldInput('theme')}}">
                <textarea class="form-control" name="body" placeholder="Текст заметки">{{session()->getOldInput('body')}}</textarea>
                <button class="btn" type="submit"><i class="bi bi-plus-lg note_icon"></i></button>
            </form>
        </div>
        @if(!empty($notes))
            @foreach($notes as $note)
                <div class="col col-xl-3 col-lg-4 col-md-6 col-sm-9 mb-4 mb-5 xs_input xs_note">
                    <div class="note note_item {{$note->status->class_name}}_status flex_column_parameters">
                        <p class="date">{{$note->dateFormat()}}</p>
                        <p class="status">Приоритет: {{$note->status->name}}</p>
                        <h5 class="theme ">{{$note->theme}}</h5>
                        <p class="body overflow-hidden text-break">{{$note->body}}</p>
                        <a class="btn" href="{{route('note.delete', ['id'=>$note->id])}}"><i class="bi bi-x-lg note_icon"></i></a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
