@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                            
                <div class="jumbotron">
                    <h1 class="display-4"> TW Group Challenge App </h1>
                    <p class="lead"> Pequeña app creada para cumplir con el desafío de 
                        TW Group
                    </p>
                    <hr class="my-4">
                    <p>Debes estar logueado para poder ver publicaciones o comentarlas</p>
                    <a class="btn btn-primary btn-lg" href="{{ route('login') }}">
                        Acceder
                    </a>
                </div>
        </div>
    </div>
</div>
@endsection
