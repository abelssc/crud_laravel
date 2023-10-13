<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\NoteRequest;

class NoteController extends Controller
{
    //el controlador recibe las rutas dinamicas en orden segun como se definan en la ruta
    public function index(): View
    {   
        $notes=Note::all();
        return view('note.index',compact('notes'));
    }
    // public function show($ixd){
    //     $note=Note::find($ixd);
    //     return view('note.show',compact('note'));
    // }
    public function show(Note $note): View{
        return view('note.show',compact('note'));
    }
    public function create(): View{
        return view('note.create');
    }
    public function store(NoteRequest $request): RedirectResponse{
        // Forma 1 ventajas: se puede manipular los datos antes de guardarlos
        // $note=new Note();
        // $note->title=$request->title;
        // $note->description=$request->description;
        // $note->save();
        // Forma 2 ventajas:
        // $note=Note::create([
        //     'title'=>$request->title,
        //     'description'=>$request->description
        // ]);
        // Forma 3 para eso el formulario debe tener los campos name con el mismo nombre de los campos de la tabla
        // $note=Note::create($request->all());
        // return redirect()->route('note.show',$note->id);

        //VALIDACIONES
        // $request->validate([
        //     'title'=>'required|max:255|min:3',
        //     'description'=>'required|max:255|min:3'
        // ]);
        //VALIDAR EN EL CONTROLADOR NO ES BUENA PRACTICA
        // ENGORDAMOS EL CONTROLADOR
        // LE ASIGNAMOS OTRAS RESPONSABILIDADES VALIDAR Y GUARDAR
        // PROVOCANDO DUPLICIDAD DE CODIGO STORE Y UPDATE
        // PARA ELLO PODEMOS CREAR UNA CUSTOM REQUEST "PETICION PERSONALIZADA"
        // PHP ARTISAN MAKE:REQUEST

        //VALIDACIONES CON LA CLASE NOTEREQUEST
        //cambiamos el formato del argumento de Request a NoteRequest
        //La clase NoteRequest verificara si el user tiene esta autorizado 
        //y si lo esta aplicara las reglas de validacion

        $note=Note::create($request->all());
        // TRAS BAMBALINAS LO QUE HACE EL METODO WITH GUARDA UNA COOKIE DE SESSION CON EL NOMBRE ASIGNADO EN WITH PARA PODER OBTENERLA LUEGO USANDO SESSION::get(nombre)
        return redirect()->route('note.show',$note->id)->with('success','Note created');
    }
    //Forma 1 para pinta la vista de edicion
    // public function edit($id){
    //     $note=Note::find($id);
    //     return view('note.edit',compact('note'));
    // }
    //Forma 2 para pinta la vista de edicion
    public function edit(Note $note): View{
        return view('note.edit',compact('note'));
    }
    public function update(NoteRequest $request, Note $note):RedirectResponse{
        // Update recibe dos parametros
        //1° parametro es el formulario y sus datos
        //2° parametro es el id el cual se esta actualizando
        // Notas: usamos {note} en vez de {id} para hacer uso de los atajos de laravel y hacer mas corto nuestro codigo apoyandonos de la Clase Note y update request all
        //Forma 1
        // $note= Note::find($note);
        // $note->title=$request->title;
        // $note->description=$request->description;
        // $note->save();
        //Forma 2
        // $note->update($request->all());
        // return redirect()->route('note.show',$note);

        $note->update($request->all());
        return redirect()->route('note.show',$note)->with('success','Note Updated');

    }
    // Si no usamos la Request podemos obiarla
    // public function delete(Request $request,Note $note)
    public function delete(Note $note):RedirectResponse{
        $note->delete();
        return redirect()->route('note.index')->with('danger','Note deleted');
    }
}

// DESDE LARAVEL 10 ¨PODEMOS TIPAR EL TIPO DE DATO QUE RETORNAMOS
// PARA VISTAS ES use Illuminate\View\View;
// PARA REDIRECCIONES use Illuminate\Http\RedirectResponse;

// PARA CREAR CONTROLADORES PARA UN CRUD COMPLETO "recurso" podemos usar:
// php artisan make:controller PostController --resource