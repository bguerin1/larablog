<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request){
        
        // Validation des paramètres du formulaire de publication de commentaires

        $request->validate(
            [
                'content' => 'required|string|max:2000',
                'articleId' => 'required',
            ],
            [
                'required' => 'Le champ :attribute est obligatoire.',
                'string' => 'Le champ :attribute doit être une chaîne de caractères.',
                'max' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
            ],
            [
                'content' => 'content',
                'articleId' => 'articleId',
            ]
        );
        
        if (Auth::check()) {

            $content = $request->content;
            $articleId = $request->articleId;

            $article = Article::find($articleId);

            if($article == null || $article->draft == 1){

                // Erreur générale pour éviter d'en dire trop 
                return redirect()->route('dashboard')->with('error', 'Cet article n\'est pas disponible !');
            }

            Comment::create([
                'content' => $content,
                'article_id' => $articleId,
                'user_id' => Auth::user()->id
            ]);

            return redirect()->back()->with('success', 'Commentaire ajouté !');
        }
        else{
            return redirect()->route('login')->with('error','Vous devez être connecté pour ajouter un commentaire !');
        }
    }

    public function removeComments(Comment $comment){
        // Suppression des commentaires possible uniquement s'il s'agit d'un article dont on est l'auteur
        if($comment->article->user_id != Auth::user()->id){
            return redirect()->back()->with('error', 'Ce commentaire est indisponible !');
        }
        
        $comment->delete();
        
        return redirect()->back()->with('success', 'Commentaire supprimé !');
    }
}
