@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">Asignación de Citas</h2>
        </div>
        <div class="d-flex justify-content-between align-items-center"> <!-- Aplicando clases de Bootstrap para alinear elementos -->
            <div>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">Crear Citas</a>
            </div>
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Cerrar sesión</button> <!-- Cambiando el color a rojo -->
                </form>
            </div>
        </div>
    </div>

    @if (Session::get('success'))
    <div class="alert alert-success mt-2">
            <strong>{{Session::get('success')}} <br>
        </div>
    @endif
    <div class="col-12 mt-4">
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Nombre Paciente</th>
                <th>Motivo cita</th>
                <th>Fecha Cita</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
            @foreach ($tasks as $task)
            <tr>
                <td class="fw-bold">{{$task->title}}</td>
                <td>{{$task->description}}</td>
                <td>
                    {{$task->due_date}}
                </td>
                <td>
                    <span class="badge bg-warning fs-6">{{$task->status}}</span>
                </td>
                <td>
                    <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn btn-warning">Editar</a>


                    <form action="{{route('tasks.destroy', $task)}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{$tasks->links()}}
    </div>
</div>
@endsection