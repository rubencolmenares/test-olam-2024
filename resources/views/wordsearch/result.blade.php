@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sopa de letras</div>
                    <div class="card-body">
                    <h1>Palabras Encontradas:</h1>
                    <ul>
                        @foreach ($found as $word => $occurrences)
                            <li>
                                {{ $word }}
                            </li>
                        @endforeach
                    </ul>

                    <h1>Palabras No Encontradas:</h1>
                    <ul>
                        @foreach ($notFound as $word)
                            <li>{{ $word }}</li>
                        @endforeach
                    </ul>
                    </div>
                    <div class="card-footer">
                        <a href="/" class="btn btn-primary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
