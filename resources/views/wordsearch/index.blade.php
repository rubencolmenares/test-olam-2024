@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sopa de letras</div>
                    <div class="card-body">
                        <form method="POST" action="/search">
                            @csrf

                            <div class="form-group">
                                <label for="words">Palabras (separadas por comas):</label>
                                <input id="words" type="text" class="form-control" name="words" required>
                            </div>

                            <div class="form-group">
                                <label for="matrix">Matriz de Letras:</label>
                                <textarea id="matrix" class="form-control" name="matrix" rows="14" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
