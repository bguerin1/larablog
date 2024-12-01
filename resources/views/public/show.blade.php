<x-guest-layout>
    <div class="min-h-screen flex flex-col pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-full  ml-16 mt-6 px-6 py-4 dark:bg-gray-800 overflow-hidden sm:rounded-lg">
    
            <div>
                <a href="/{{$user->id}}">← Retour à la liste des articles</a>
            </div>
            <div class="bg-white mt-3 p-6">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ $article->title }}
                    </h2>
                </div>

                <div class="text-gray-500 text-sm mt-2">
                    Publié le {{ $article->created_at->format('d/m/Y') }} par <a href="{{ route('public.index', $article->user->id) }}">{{ $article->user->name }}</a>
                </div>

                <div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-gray-700 dark:text-gray-300">{{ $article->content }}</p>
                    </div>
                </div>
            </div>
        </div>
        @auth
            <div class="max-w-full  ml-16 mt-2 px-6 py-4 dark:bg-gray-800 overflow-hidden sm:rounded-lg">
                <div class="bg-white mt-3 p-6">
                    <div>
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Commentaires</h3>
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

                    <!-- Liste des commentaires --> 

                    <div style="height:350px; overflow-y:scroll;">
                        @foreach ($article->comments as $comment)
                            @if($comment == null)
                                <div class="bg-white mt-3 p-6">
                                    <p class="text-gray-700">Aucun commentaire pour le moment.</p>
                                </div>
                            @endif
                            <div class="bg-white mt-3 p-6">
                                <div class="flex flex-inline">
                                    <p class="text-gray-700 mb-3 font-semibold mr-2">{{$comment->user->name}} </p>
                                    <p>{{$comment->created_at->format('d/m/Y')}} à {{$comment->created_at->format('H:i')}}</p>
                                </div>
                                <p class="text-gray-700">{{$comment->content}}</p>
                            </div>
                        @endforeach
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
            </div>
        @endauth
    </div>
</x-guest-layout>