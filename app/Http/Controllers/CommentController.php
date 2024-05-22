<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    
     //Almacena un nuevo comentario.
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
        ]);

        $comment = new Comment();
        $comment->text = $request->input('text');
        $comment->project_id = $request->input('project_id');
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect()->route('projects.show', $request->input('project_id'))->with('success', 'Commentario Guardado con éxito');
    }

}