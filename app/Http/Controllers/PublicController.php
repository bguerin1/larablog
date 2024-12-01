<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(User $user)
    {
        $articles = Article::where('user_id', $user->id)->where('draft', 0)->orderBy('created_at', 'desc')->paginate(6);
        $categories = Category::all();

        return view('public.index', [
            'articles' => $articles,
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function show(User $user, Article $article)
    {
        // Vérification de la publication de l'article 

        if($article->draft == 1){
            return redirect()->route('dashboard')->with('error', 'Cet article n\'existe pas !');
        }

        return view('public.show', [
            'article' => $article,
            'user' => $user
        ]);
    }
}
