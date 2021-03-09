@extends('layouts.app')

@section('content')

    <form action="{{ route('publications.store') }}" method="POST">
        @csrf

        <div class="col-md-6">
            <div class="mb-3">
                <label for="title" class="form-label"> Título de la publicación </label>
                <input 
                    type="text" 
                    name="title"
                    class="form-control" 
                    placeholder="Título" 
                    autofocus
                    value={{ old('title') }}
                >
                @error('title')
                    <span class="invalid-feedback d-block" role="alert"> <strong> {{ $message }} </strong> </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label"> Contenido </label>
                <textarea 
                    class="form-control" 
                    name="content" 
                    rows="3" 
                    placeholder="Escribe algo..."
                    value={{ old('content') }}
                ></textarea>
                @error('content')
                    <span class="invalid-feedback d-block" role="alert"> <strong> {{ $message }} </strong> </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block">Publicar</button>
        </div>

   
    </form>

@endsection