@extends('layouts.base')

@section('content')
<div class="row">

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="d-flex justify-content-center align-items-center vh-100">
        <form action="{{ route('login') }}" method="POST" class="border p-5 rounded-lg shadow-lg" style="max-width: 400px;">
            @csrf
            <h2 class="text-center mb-4 text-primary">Iniciar Sesión</h2>
            <div class="form-group mb-4">
                <label for="email" class="font-weight-bold">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingresar email" required>
            </div>
            <div class="form-group mb-4">
                <label for="password" class="font-weight-bold">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingresar Contraseña" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </div>
            <div class="text-center">
                <p>¿No tienes una cuenta? <a href="{{ route('register.show') }}" class="text-primary">Regístrate aquí</a></p>
            </div>
        </form>
    </div>


</div>
@endsection