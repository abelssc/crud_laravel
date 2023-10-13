@extends('layouts.app')
@section('content')
    <h1>Note</h1>
    <!-- <pre>
        {{var_dump($note)}}
    </pre> -->

    <a href="{{ route('note.index') }}">Ver Notas</a>
    <ul>
        <li>id: {{$note->id}}</li>
        <li>title: {{$note->title}}</li>
        <li>description: {{$note->description}}</li>
        <li>updated: {{$note->updated_at}}</li>
        <li>created: {{$note->created_at}}</li>
    </ul>
@endsection
