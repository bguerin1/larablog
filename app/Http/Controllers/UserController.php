<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $articles = Article::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(6);

        return view('dashboard', ['articles' => $articles]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.create',['categories' => $categories]);
    }

    public function store(Request $request)
    {
        // Validation des paramètres du formulaire de création de l'article 

        $request->validate(
            [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'draft' => '',
                'categories' => 'required','array'
            ],
            [
                'required' => 'Le champ :attribute est obligatoire.',
                'string' => 'Le champ :attribute doit être une chaîne de caractères.',
                'max' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
                'array' => 'Le champ :attribute doit être un tableau.',
            ],
            [
                'title' => 'title',
                'content' => 'content',
                'draft' => 'draft',
                'categories' => 'categories',
            ]
        );

        $article_categories = $request->only(['categories']);

        // Titre

        $data['title'] = $request->title;

        // Contenu 

        $data['content'] = $request->content;

        // Créateur de l'article (auteur)

        $data['user_id'] = Auth::user()->id;

        // Gestion du draft
        
        $data['draft'] = isset($request->draft) ? 1 : 0;


        // Création de l'article 
       
        $article = Article::create($data); 

        // Associer l'article à une catégorie 

        $article->categories()->sync($article_categories['categories']);

        // On redirige l'utilisateur vers la liste des articles
        return redirect('/dashboard')->with('success','L\'article a bien été créé');
    }

    public function edit(Article $article)
    {
        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', 'Vous n\'avez pas le droit d\'accéder à cet article !');
        }
        
        $categories = Category::all();

        return view('articles.edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Article $article)
    {
        
        // Validation des paramètres du formulaire de modification de l'article 

        $request->validate(
            [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'draft' => '',
                'categories' => '',
            ],
            [
                'required' => 'Le champ :attribute est obligatoire.',
                'string' => 'Le champ :attribute doit être une chaîne de caractères.',
                'max' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
                'int' => 'Le champ :attribute doit être un entier.'
            ],
            [
                'title' => 'title',
                'content' => 'content',
                'draft' => 'draft',
                'categories' => 'categories',
            ]
        );


        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', 'Vous n\'avez pas le droit d\'accéder à cet article !');
        }

        $article_categories = $request->only(['categories']);

        // Titre

        $article->title = $request->title;
        
        // Contenu 

        $article->content = $request->content;

        // Créateur de l'article (auteur)

        $article->user_id = Auth::user()->id;

        // Brouillon

        $article->draft = isset($request->draft) ? 1 : 0;
        
        $article->save();


        // Associer l'article à une/plusieurs catégorie une fois modifié

        if(!$article_categories == []){
            $article->categories()->sync($article_categories['categories']);
        }

        return redirect()->route('dashboard')->with('success', 'Article mis à jour !');
    }

    public function remove(Article $article){
        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', 'Vous n\'avez pas le droit de supprimer un article qui ne vous appartiens pas !');
        }

        // Suppression des catégories liées à l'article pour garder le RESTRICT en base de données

        $article->categories()->detach();

        // Suppression de l'article 

        $article->delete();
        return redirect()->back()->with('success', 'L\'article a bien été supprimé !');
    }

    
}
