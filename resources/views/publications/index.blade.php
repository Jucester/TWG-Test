@extends('layouts.app')

@section('buttons')

    @include('layouts.nav')

@endsection

@section('content')

    <h1 class="text-center pb-4"> Publicaciones </h1>

    <ul class="list-group">
        @forelse ($publications as $publication)
            <li class="list-group-item mb-2"> 
                <h3 class="title"><a href="{{ route('publications.show', $publication->id ) }}">  {{ $publication->title }}   </a> </h3>
                <div class="d-flex justify-content-between align-items-center p-2">
                    <p> {{ $publication->text }}  </p>

                  
                </div>
                
            </li>
        @empty
            <li> No se han hecho publicaciones aún </li>
        @endforelse
    </ul>

@endsection