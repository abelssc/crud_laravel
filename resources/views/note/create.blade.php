@extends('layouts.app')
@section('content')
    <div style="max-width: 500px; margin: 200px auto; background-color: #f2f2f2;padding:1rem 1rem 2rem;border-radius:10px">
        <a href="{{ route('note.index') }}">Back</a>
        <h1>Crear Nota</h1>
        {{-- laraven tambien devuelve errores en forma de instancia --}}
        @if($errors->any())
            <pre>
                {{ var_dump($errors) }}
            </pre>
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <form action="{{ route('note.store') }}" method="POST" style="display: flex;flex-direction: column;gap:.5rem">
        <!-- SI NO INCLUIMOS EL TOKER CROSS SITE RECIBIREMOS UN ERROR DE FORBIDDEN  YA QUE LARAGON EXIGE ESTA SEGURIDAD POR DEFECTO -->
            @csrf
            <label for="">Title</label>
            <!-- la directiva error  funciona como condicional if error echo
                recibe como parametro el name del input al que hace referencia
            -->
            <input type="text" placeholder="title" name="title" class="@error('title') danger @enderror">
            <!-- la directiva error se vale de la clase request y si cumplen las validaciones -->
            @error('title')
            <!-- la directiva error brinda una directiva message -->
            <p style="color:red;">{{ $message }}</p>
            <!-- estos mensages predefinidos se apoyan de la carpeta lang, en laravel 10 ya no existe esa carpeta xd se deben generar con vendor:publish .... -->
            @enderror
            <label for="">Description</label>
            <textarea name="description" id="" cols="30" rows="10" placeholder="Descripcion"></textarea>
            @error('description')
            <p style="color:red;">{{ $message }}</p>
            @enderror
            <button type="submit">Guardar</button>
        </form>
    </div>

@endsection