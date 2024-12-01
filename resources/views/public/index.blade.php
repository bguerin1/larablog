<x-guest-layout>
    <div class="min-h-screen justify-center items-center flex flex-col pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-1/2 max-w-full mt-6 px-6 py-4 dark:bg-gray-800 overflow-hidden sm:rounded-lg">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Liste des articles publiés par {{ $user->name }}
                </h2>
            </div>
            <div>
                <!-- Articles -->
                @foreach ($articles as $article)
                    <div class="bg-white mt-3">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h2 class="text-2xl font-bold">{{ $article->title }}</h2>
                            <p class="text-gray-700 dark:text-gray-300">{{ substr($article->content, 0, 30) }}...</p>

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