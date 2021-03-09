@extends('layouts.app')

@section('content')

    <form action="{{ route('publications.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label"> Título de la publicación </label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Título" autofocus>
        </div>
        <div class="mb-3">
            <label for="text" class="form-label"> Texto </label>
            <textarea class="form-control" name="text" rows="3" placeholder="Escribe algo..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>

@endsection