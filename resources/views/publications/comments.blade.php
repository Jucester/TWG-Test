@extends('layouts.app')


@section('buttons')

<a href="{{ url('/profile') }}" class="btn btn-outline-primary font-weight-bold m-2"> 
    Ir al perfil
 </a>
@endsection

@section('content')
  
   <div class="container">
       <h1 class="text-center font-weight-bold mb-4"> Tus publicaciones </h1>
       <div class="row mx-auto bg-white p-4">
            @if( count($comments) > 0 ) 

            <table class="table">
                <thead class="bg-primary text-light">
                    <tr>
                        <th scole="col"> Autor </th>
                        <th scole="col"> Contenido </th>
                        <th scole="col"> Acciones </th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($comments as $comment)

                    <tr>
                        <td> {{ $comment->user->name }} </td>
                        <td> {{ $comment->content}} </td>
                        <td class="d-flex">
                            <a href="{{ route('comment.approve', ['comment' => $comment->id] ) }}" class="btn btn-success mr-1"> Aprobar </a>

                            <form action="{{ route('comment.destroy', ['comment' => $comment->id] ) }}" method="POST">
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
                <p class="text-center w-100">
                    Aún no hay comentarios en tu publicación
                </p>
            @endif

       </div>
       
   </div>

@endsection