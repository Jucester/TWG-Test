@extends('layouts/app')

@section('content')

    <article class="bg-white p-5 shadow">
        <h1 class="text-center font-weight-bold mb-4"> {{ $publication->title }} </h1>

        <div class="container">
            <div class="row">
            
                <div class="story-meta mt-4">
                    <p>
                        <span class="font-weight-bold text-primary"> Autor: </span>
                        <a class="text-dark" href="#">
                            {{ $publication->user->name }}
                        </a>
                    </p>

                    <p>
                        <span class="font-weight-bold text-primary"> Fecha: </span>                      
                            {{ $publication->created_at->diffForHumans() }}       
                    </p>
        
                    <div class="text-dark mt-4 p-4">
                        <p class="lh-base fs-4">
                            {{ $publication->content }}
                        </p>  
                    </div>
    
                </div>
            </div>
        </div>

    </article>

    <div class="container p-4">

        @forelse ($publication->comments as $comment)
           <h4>  {{ $comment->user->name }}</h4>
           <p>  {{ $comment->content }} </p>

        @empty
            No se han añadido comentarios aún. ¡Sé el primero!
        @endforelse

    </div>

    <div>

        @if ($commented == true)
            <p> Ya has comentado esta publicación. Solo se permite un comentario por usuario. </p>
        @else 
            <form action="{{ route('comment.store', ['publicationId' => $publication->id] ) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="content" class="form-label"> Añade un comentario: </label>
                    <textarea class="form-control" name="content" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary"> Añadir  </button>
            </form>
        @endif

 
    </div>

@endsection