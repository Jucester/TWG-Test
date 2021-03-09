<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Listar publicaciones
        $publications = Publication::all();

        return view('publications.index', compact('publications'));
    }

    /**
     * Display a listing of the resource from the authenticated user
     * 
     * No es un "Profile" realmente, solo lo nombre así para hacer referencia a que sería, en espiritu, el dashboard donde el user vería sus publicaciones
     * 
     * @return \Illuminate\Http\Response
     */
    public function profile(User $user)
    {
        // Listar publicaciones del usuario authenticado
        $publications = Publication::where('user_id', Auth::user()->id)->get();

        return view('publications.profile', compact('publications'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Render form
        return view('publications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        auth()->user()->publications()->create([
            'title' => $data['title'],
            'content' => $data['content']
        ]);

        return redirect()->action('App\Http\Controllers\PublicationController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication)
    {
        // Show the comments of a specific publication
        $comments = Comment::where('publication_id', $publication->id)->where('status', 'APROBADO')->get();
        // Check if authenticated user already commented this post
        $commented = Comment::where('publication_id', $publication->id)
                        ->where('user_id', Auth::user()->id)->first() ? true : false;

        return view('publications.show', compact('publication', 'comments', 'commented'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {
        // Revisar la policy para que solo el creador pueda ver el formulario de edición
        $this->authorize('view', $publication);

        return view('publications.edit', compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
        // Revisar la policty (para comprobar que el usuario que intenta actualizar es el creador)
        $this->authorize('update', $publication);

        // Validar los datos
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $publication->title = $data['title'];
        $publication->content = $data['content'];

        $publication->save();

        return redirect()->action('App\Http\Controllers\PublicationController@show', $publication->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
       // Revisar la policty (para comprobar que el usuario que intenta eliminar es el creador)
       $this->authorize('update', $publication);
       
       $publication->delete();

       return redirect()->action('App\Http\Controllers\PublicationController@index');
    }


    // Funciones adicionales

    // Renderizar una vista con una lista de los comentarios de una publicación
    public function comments(Publication $publication)
    {
        $comments = Comment::where('publication_id', $publication->id)->get();

        return view('publications.comments', compact('comments'));
    }

    
}
