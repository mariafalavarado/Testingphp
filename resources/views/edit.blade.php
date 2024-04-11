@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Editar Cita</h2>
        </div>
        <div>
            <a href="{{route('tasks.index')}}" class="btn btn-primary">Volver</a>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <strong>Ops!</strong> Algo está mal..<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('tasks.update', $task)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Nombre Paciente:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Nombre" value="{{$task->title}}" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Motivo:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Motivo de la cita..."> {{$task->description}} </textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Fecha Cita:</strong>
                    <input type="datetime-local" name="due_date" class="" value="{{$task->due_date}}" id="">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Estado :</strong>
                    <select name="status" class="form-select" id="">
                        <option value="">-- Elige el nuevo estado --</option>
                        <option value="Programada" @selected("Programada" == $task->status)> Programada </option>
                        <option value="Cumplida" @selected("Cumplida" == $task->status)> Cumplida </option>
                        <option value="Incumplida" @selected("Incumplida" == $task->status)> Incumplida </option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Actualizar Cita</button>
            </div>
        </div>
    </form>
</div>
@endsection