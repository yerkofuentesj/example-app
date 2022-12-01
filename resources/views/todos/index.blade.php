@extends('app') <!-- Agrega extencion de la pagina maestra -->
@section('content') <!-- Aca va todo el contenido que se agrega hacia la pagina -->
<div class="container w-25 border p-4 mt-4">
<form action="{{ route('todos') }}" method="POST"> <!-- asi se puede redireccionar una URL  -->
@csrf
<!-- Cross Site Request Forgery: Metodo tipo TOKEN -->
@if (session('success'))
    <!-- condicion de aceptacion -->
    <h6 class="alert alert-success">{{ session('success') }}</h6>
@endif
@error('title')
    <!-- condicion de error -->
    <h6 class="alert alert-danger">{{ $message }}</h6>
@enderror
  <div class="mb-3">
    <label for="title" class="form-label">Titulo de la tarea</label>
    <input type="text" class="form-control" name="title">
  </div>
  <button type="submit" class="btn btn-primary">Crear nueva tarea</button>
</form>
<div>
    @foreach ($todos as $todo)
        <div class="row py-1">
            <div class="col-md-9 d-flex align-items-center">
                <a href="{{ route('todos-edit', ['id' => $todo->id]) }}">{{ $todo->title }}</a>
            </div>
            <div class="col-md-3 d-flex align-items-center">
                <form action="{{ route('todos-destroy', [$todo->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
</div>
@endsection

<!-- 
* Documentacion de cada hito del Laravel basico
*
* php artisan make:model (nombre) -m
* > Aca va se agrega el controlador con su respectiva consulta hacia la BD en MySQL <
*
* php artisan migrate:status
* > Consulta el estado para subir las bases de datos hacia el MySQL <
*
* php artisan migrate
* > Emigra toda las tablas hacia el servidor <
*
* php artisan migrate:rollback
* > dehacer cambio de la migracion <
*
* php artisan make:controller (nombre)
* > Crea un controlador para las vistas <
*
* php artisan optimize:clear
* > Limpia el cache de laravel <    
*
* php artisan make:controller (nombre) --resource
* > Crea un controlador para las vistas con recursos <
*
* php artisan route:list
* > Muestras las rutas operativos <   
--> 