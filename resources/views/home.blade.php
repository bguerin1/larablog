<x-guest-layout>
    <div class="min-h-screen flex flex-col pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-full ml-6 mt-6 px-6 py-4 dark:bg-gray-800 overflow-hidden sm:rounded-lg">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Liste des articles les plus likés
                </h2>
            </div>
            <div>
                <!-- Articles -->
                @foreach ($articles as $article)
                    <div class="bg-white mt-3">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex justify-between">
                                <h2 class="text-2xl font-bold">{{ $article->title }}</h2>
                                <div>
                                    @auth
                                        <a href="{{ route('article.like', $article->id) }}" class="inline-block  bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61" clip-rule="evenodd" />
                                            </svg>
                                            @if($article->likes == 0)
                                            <span>0</span>
                                            @endif
                                            <span>{{$article->likes}}</span>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                            <div class="flex flex-inline">
                                @foreach($article->categories as $category)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400 mt-3">{{$category->name}}</span>
                                @endforeach
                            </div>
                            <p class="text-gray-700 dark:text-gray-300 mt-3 mb-3">{{ substr($article->content, 0, 30) }}...</p>
                            <a href="{{ route('public.show', [$article->user_id, $article->id]) }}" class="text-red-500 hover:text-red-700">Lire la suite</a>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="mt-3">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-guest-layout>