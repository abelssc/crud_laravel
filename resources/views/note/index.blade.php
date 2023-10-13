@extends('layouts.app')
@section('content')
    <h1>Notes</h1>
    <a href="{{ route('note.create') }}">Crear nota</a>
    <ul>
        @forelse ($notes as $note)
            <li>
                <a href="{{ route('note.show', $note->id) }}">{{ $note->title }}</a> |
                <a href="{{ route('note.edit',$note->id) }}">EDIT</a> |
                <form action="{{ route('note.delete',$note->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" value="DELETE">
                </form>
            </li>
        @empty
            <p>No hay datos.</p>
        @endforelse
    </ul>
@endsection
