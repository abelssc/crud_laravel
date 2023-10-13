@extends('layouts.app')
@section('content')

    
    <div style="max-width: 500px; margin: 200px auto; background-color: #f2f2f2;padding:1rem 1rem 2rem;border-radius:10px">
        <a href="{{ route('note.index') }}">Back</a>
        <h1>Crear Nota</h1>
        @if($errors->any())
            {{-- <pre>
                {{ var_dump($errors) }}
            </pre> --}}
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <!-- AHORA EN EDICION TENEMOS UN PROBLEMA; html solo ADMITE EL METODO POST Y GET, COMO LE INDICAMOS QUE QUEREMOS EJECUTAR UNA RUTA CON EL METODO PUT O DELETE? -->
        <form action="{{ route('note.update',$note->id) }}" method="POST" style="display: flex;flex-direction: column;gap:.5rem">
            <!-- MANTENEMOS EL METODO POST DEL FORM Y CREAMOS UNA DIRECTIVA CON EL METODO PUT O DELETE -->
            @method("PUT")
            @csrf
            <label for="">Title</label>
            <input type="text" placeholder="title" name="title" value="{{$note->title}}">
            @error('title')
            <p style="color:red;">{{ $message }}</p>
            @enderror
            <label for="">Description</label>
            <textarea name="description" id="" cols="30" rows="10" placeholder="Descripcion">{{$note->description}}</textarea>
            @error('description')
            <p style="color:red;">{{ $message }}</p>
            @enderror
            <button type="submit">Guardar</button>
        </form>
    </div>

@endsection