<x-guest-layout>
    <div class="min-h-screen flex flex-col pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-1/2 max-w-full ml-16 mt-6 px-6 py-4 dark:bg-gray-800 overflow-hidden sm:rounded-lg">
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
    </div>
</x-guest-layout>