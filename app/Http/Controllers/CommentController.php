<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'parent_id' => 'nullable|exists:comments,id', // Validar el parent_id si está presente
        ]);

        $comment = new Comment();
        $comment->text = $request->input('text');
        $comment->project_id = $request->input('project_id');
        $comment->user_id = Auth::id();
        $comment->parent_id = $request->input('parent_id'); // Establecer parent_id si está presente
        $comment->save();

        return redirect()->route('projects.show', $request->input('project_id'))->with('success', 'Comentario Guardado con éxito');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comentario eliminado con éxito');
    }
}
