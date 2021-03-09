<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Mail\CommentAdded;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $publicationId)
    {
        // dd($request->all());
        // Validar los datos
        $data = $request->validate([
            'content' => 'required'
        ]);

        $user_id = Auth::user()->id;
        $publication_id = (int)$publicationId;

        // Se comprueba si el usuario ya comento la publicación
        $commented = Comment::where('publication_id', $publication_id)->where('user_id', $user_id)->first();

        if($commented) {
            // Si ya comentó, es redireccionado. Es una capa adicional de validación solo por si acaso
            return redirect()->action('App\Http\Controllers\PublicationController@show', $publication_id);
        }

        Comment::create([
            'content' => $data['content'],
            'user_id' => $user_id,
            'publication_id' => $publication_id
        ]);

        $post = Publication::where('id', $publication_id)->first();
        $user = User::where('id', $post->user_id)->first();

        Mail::to($user->email)->send(new CommentAdded($data['content']));

        return redirect()->action('App\Http\Controllers\PublicationController@show', $publication_id);
    }

 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        // Eliminar un comentario
        $comment->delete();
        return redirect()->action('App\Http\Controllers\PublicationController@index');
    }


    // Aprobar un comentario
    public function approve(Comment $comment)
    {
 
        $comment->status = "APROBADO";
        $comment->save();

        return redirect()->action('App\Http\Controllers\PublicationController@index');
    }
}
