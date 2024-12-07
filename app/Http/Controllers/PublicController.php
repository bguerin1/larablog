<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            'user' => $user,
        ]);
    }

    public function like(Article $article){
        try{
            // Vérification de la publication de l'article 

            if($article->draft == 1){
                return redirect()->route('dashboard')->with('error', 'Cet article est indisponible !');
            }

            $article->likes += 1;
            $article->save();
            return redirect()->back()->with('success','Like ajouté avec succès !');
        }
        catch(Exception $e){
            return redirect()->back()->with('error','L\'ajout du like a échoué !');
        }
    }

    public function home(){
        $articles = Article::where('draft', 0)->orderBy('likes', 'desc')->paginate(6);
        $categories = Category::all();

        return view('home', [
            'articles' => $articles,
            'categories' => $categories
        ]);
    }

    // Filtre de recherche page Home

    public function filter(Request $request){
        $request->validate(
            [
                'categories' => 'required|array',

            ],
            [
                'required' => 'Le champ :attribute est obligatoire.',
                'array' => 'Le champ :attribute doit être une chaîne de caractères.',
            ],
            [
                'categories' => 'categories',
            ]
        );

        $filter_categories = $request->only(['categories']);
        $articles = Article::whereHas('categories',fn($q)=>$q->whereIn('id', $filter_categories['categories']))->where('draft',0)->paginate(6)->appends(['categories' => $filter_categories['categories']]);
        $categories = Category::all();

        return view('home', [
            'articles' => $articles,
            'categories' => $categories

        ]);        
    }   

    public function search(Request $request){
        $request->validate(
            [
                'search' => 'required|string|max:255',
            ],
            [
                'required' => 'Le champ :attribute est obligatoire.',
                'string' => 'Le champ :attribute doit être une chaîne de caractères.',
                'max' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
            ],
            [
                'search' => 'search',
            ]
        );

        $search = $request->search;
        $articles = Article::where('title', 'like', '%' . $search . '%')->where('draft',0)->paginate(6)->appends(['search' => $search]);
        $categories = Category::all();
        return view('home', [
            'articles' => $articles,
            'categories' => $categories

        ]); 
    }

}
