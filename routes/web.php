<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

// Partie publique 

// Page d'accueil du site
Route::get('/', [PublicController::class, 'home'])->name('home');
// Filtre de catégories des articles 
Route::get('/articles/filter/', [PublicController::class, 'filter'])->name('articles.filter');
// Recherche d'articles 
Route::get('/articles/search/', [PublicController::class, 'search'])->name('articles.search');


Route::middleware('auth')->group(function () {
    // Routes d'utilisateurs connectés importées de Breeze 
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Partie Articles

    // Vue avec form de création 
    Route::get('/articles/create', [UserController::class, 'create'])->name('articles.create');
    // Création de l'article en base de données
    Route::post('/articles/store', [UserController::class, 'store'])->name('articles.store');
    // Vue avec form de modification d'un article
    Route::get('/articles/{article}/edit', [UserController::class, 'edit'])->name('articles.edit');
    // Modification de l'article en base de données
    Route::post('/articles/{article}/update', [UserController::class, 'update'])->name('articles.update');
    // Suppression d'un article
    Route::get('/articles/{article}/remove', [UserController::class, 'remove'])->name('articles.remove');
    
    // Partie publique 
    
    // Like des articles 
    Route::get('/articles/{article}/like/', [PublicController::class, 'like'])->name('article.like')->middleware('throttle:3,1');

    // Partie Commentaires 

    // Ajout de commentaires sur un article
    Route::post('/comments/store', [CommentController::class, 'store'])->middleware('throttle:3,1')->name('comments.store');
    // Suppression des commentaires d'un article 
    Route::get('/comments/{comment}/remove', [CommentController::class, 'removeComments'])->name('comments.remove');

});

require __DIR__.'/auth.php'; 

// Partie publique 

// Affichage des articles d'un utilisateur spécifique
Route::get('/{user}', [PublicController::class, 'index'])->name('public.index');
// Affichage des détails d'un article
Route::get('/{user}/{article}', [PublicController::class, 'show'])->name('public.show');
