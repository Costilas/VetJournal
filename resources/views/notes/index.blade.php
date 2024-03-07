@extends('layouts.body.app.layout')

@section('title') VetJournal::{{__('notes.tab_title')}} @endsection

@section('content')
    <div class="row row-cols-1 mt-5 note_wrapper">
        <div class="col col-xl-3 col-lg-4 col-md-6 col-sm-9 mb-4 mb-5 xs-w-9 ">
            <form class="note flex_column_parameters" method="POST" action="{{route('note.create')}}">
                @csrf
                <select class="form-control" name="status_id" required>
                    @foreach($statuses as $status)
                        <option @if(session()->getOldInput('status_id')===$status->id) selected
                                @endif value="{{$status->id}}">{{$status->name}}</option>
                    @endforeach
                </select>
                <input class="form-control"
                       type="text" name="theme"
                       placeholder="{{__('notes.view.placeholder.theme')}}"
                       value="{{session()->getOldInput('theme')}}"
                       required
                       maxlength="25">
                <textarea class="form-control"
                          name="body"
                          placeholder="{{__('notes.view.placeholder.text')}}"
                          required
                          maxlength="255">{{session()->getOldInput('body')}}</textarea>
                <button class="btn" type="submit"><i class="bi bi-plus-lg note_icon"></i></button>
            </form>
        </div>
        @if($notes->count())
            @foreach($notes as $note)
                <div class="col col-xl-3 col-lg-4 col-md-6 col-sm-9 mb-4 mb-5 xs-w-9">
                    <div class="note note_item {{$note->status->class_name}}_status flex_column_parameters">
                        <p class="date">{{$note->creationDate()}}</p>
                        <p class="status">{{__('notes.view.note.priority')}} {{$note->status->name}}</p>
                        <h5 class="theme ">{{$note->theme}}</h5>
                        <p class="body overflow-hidden text-break">{{$note->body}}</p>
                        <a class="btn" href="{{route('note.delete', ['id'=>$note->id])}}"><i
                                class="bi bi-x-lg note_icon"></i></a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
