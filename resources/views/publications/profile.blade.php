@extends('layouts.app')


@section('buttons')

<a href="{{ url('/publications') }}" class="btn btn-outline-primary font-weight-bold m-2"> 
    Ir al feed
 </a>
@endsection

@section('content')
  
   <div class="container">
       <h1 class="text-center font-weight-bold mb-4"> Tus publicaciones </h1>
       <div class="row mx-auto bg-white p-4">
            @if( count($publications) > 0 ) 

            <table class="table">
                <thead class="bg-primary text-light">
                    <tr>
                        <th scole="col"> Titulo </th>
                        <th scole="col"> Comentarios </th>
                        <th scole="col"> Acciones </th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($publications as $publication)

                    <tr>
                        <td> {{ $publication->title }} </td>
                        <td> {{ count($publication->comments) }} </td>
                        <td class="d-flex">
                            <a href="{{ route('publications.show', ['publication' => $publication->id] ) }}" class="btn btn-success mr-1"> Ver </a>
                            <a href="{{ route('publications.edit', ['publication' => $publication->id] ) }}" class="btn btn-dark mr-1 "> Editar </a>
                            <a href="{{ route('publications.comments', ['publication' => $publication->id] ) }}" class="btn btn-secondary mr-1 "> Comentarios </a>
                            
                            <form action="{{ route('publications.destroy', ['publication' => $publication->id] ) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mr-1 "> Eliminar </button>
                            </form>
                            
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>


            @else
                <p class="text-center w-100"> Aún no tienes publicaciones. ¡Crea la primera! <br>  
                    <a href="{{ route('publications.create') }}" class="btn btn-outline-primary 2 font-weight-bold m-2"> 
                        Crear publicación 
                     </a>
                </p>
            @endif

       </div>
       
   </div>

@endsection