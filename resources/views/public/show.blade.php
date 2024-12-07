<x-articles-layout>
    <!-- Retour Arrière -->
    <div>
        <a href="/">← Retour à la liste des articles</a>
    </div>

    <!-- Message flash -->
    @if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg mt-6 mb-6 text-center">
        {{ session('success') }}
    </div>
    @endif
    <!-- Message d'erreur -->
    @if (session('error'))
        <div class="bg-red-500 text-white p-4 rounded-lg mt-6 mb-6 text-center">
            {{ session('error') }}
        </div>
    @endif

    <!-- Partie Article -->
    <div class="bg-white mt-3 p-6 rounded-lg flex justify-between">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Titre de l'article -->
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mr-5 truncate">
                    {{ $article->title }}
                </h2>
                <!-- Bouton de like de l'article -->
                @auth
                    <a href="{{ route('article.like', $article->id) }}" 
                       class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2">
                            {{ $article->likes > 0 ? $article->likes : '0' }}
                        </span>
                    </a>
                @endauth
            </div>
            <!-- Date de publication et auteur -->
            <div class="text-gray-500 text-sm mt-3">
                Publié le {{ $article->created_at->format('d/m/Y') }} par {{ $article->user->name }}
            </div>
            <!-- Catégories -->
            <div class="flex flex-wrap mt-2 gap-2">
                @foreach($article->categories as $category)
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
            <!-- Contenu de l'article -->
            <div class="p-6 text-gray-900 dark:text-gray-100 overflow-hidden break-words">
                <p class="text-gray-700 dark:text-gray-300 text-justify">{!! nl2br(e($article->content)) !!}</p>
            </div>
        </div>
    </div>
    <!-- Partie Commentaires -->
    @auth
        <div class="bg-white mt-5 p-6 rounded-lg">
            <div>
                <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Commentaires</h3>
            </div>

            <!-- Liste des commentaires --> 
            <div style="height:200px; overflow-y:scroll;">
                @if(count($article->comments) == 0)
                    <div class="bg-white mt-3 p-6">
                        <p class="text-gray-700">Aucun commentaire pour le moment.</p>
                    </div>
                @else
                    @foreach ($article->comments as $comment)
                    <div class="mt-3 p-4 bg-gray-100 dark:bg-gray-800 rounded-lg max-w-[90%] mx-auto">
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex flex-inline">
                                <!-- Date de publication et auteur --> 
                                <p class="text-gray-700 dark:text-gray-300 font-semibold mr-2">{{ $comment->user->name }}</p>
                                <p class="text-gray-500 dark:text-gray-400">
                                    {{ $comment->created_at->format('d/m/Y') }} à {{ $comment->created_at->format('H:i') }}
                                </p>
                            </div>
                            <!-- Bouton de suppression du commentaire -->
                            @if($article->user->id == auth()->id())
                                <a href="/comments/{{$comment->id}}/remove" class="text-red-500 hover:text-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-1 12a2 2 0 01-2 2H8a2 2 0 01-2-2L5 7m5 4v6m4-6v6M6 7V4a1 1 0 011-1h10a1 1 0 011 1v3M4 7h16" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                        <!-- Contenu du commentaire -->
                        <p class="text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>
                    </div>
                    @endforeach
                @endif
            </div>

            <!-- Ajout d'un commentaire -->
            <div>
                <form action="{{ route('comments.store') }}" method="post" class="mt-6">
                    @csrf
                    <input type="hidden" name="articleId" value="{{ $article->id }}">
                    <div class="p-6 pt-0 text-gray-900 ">
                        <textarea rows="5" name="content" id="content" placeholder="Contenu du commentaires" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 resize-none"></textarea>
                    </div>
                    <div class="p-6 pt-0 text-gray-900 ">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Publier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endauth
</x-guest-layout>