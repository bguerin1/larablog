<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

Route::get('/', [PublicController::class, 'home'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Création d'articles : Form / stockage dans la base de données

    Route::get('/articles/create', [UserController::class, 'create'])->name('articles.create');
    Route::post('/articles/store', [UserController::class, 'store'])->name('articles.store');

    // Modification des articles

    Route::get('/articles/{article}/edit', [UserController::class, 'edit'])->name('articles.edit');
    Route::post('/articles/{article}/update', [UserController::class, 'update'])->name('articles.update');

    // Suppression des articles 
    
    Route::get('/articles/{article}/remove', [UserController::class, 'remove'])->name('articles.remove');
    
    // Like des articles 
    
    Route::get('/articles/{article}/like/', [PublicController::class, 'like'])->name('article.like')->middleware('throttle:3,1');

    // Ajout de commentaires

    Route::post('/comments/store', [CommentController::class, 'store'])->middleware('throttle:3,1')->name('comments.store');

    // Suppression des commentaires de notre article 

    Route::get('/comments/{comments}/remove', [CommentController::class, 'removeComments'])->name('comments.remove');

});

require __DIR__.'/auth.php'; 

// Partie publique 

// Filtre de catégories des articles 
Route::get('/articles/filter/', [PublicController::class, 'filter'])->name('articles.filter');

// Recherche d'articles 
Route::get('/articles/search/', [PublicController::class, 'search'])->name('articles.search');


Route::get('/{user}', [PublicController::class, 'index'])->name('public.index');
Route::get('/{user}/{article}', [PublicController::class, 'show'])->name('public.show');
