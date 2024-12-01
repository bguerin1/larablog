<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="mt-6 dark:bg-gray-800 overflow-hidden sm:rounded-lg">
                
                <!-- Liste des articles de l'utilisateur connecté  --> 

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Mes articles') }}
                </h2>
                @foreach($articles as $article)
                    <div class="bg-white overflow-hidden sm:rounded-lg mt-4">
                        <div class="p-6 text-gray-900">
                            <h2 class="text-2xl font-bold">{{ $article->title }}</h2>
                            <div class="flex flex-inline">
                                @foreach($article->categories as $category)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400 mt-3">{{$category->name}}</span>
                                @endforeach
                            </div>
                            <p class="text-gray-700 mt-3">{{ substr($article->content, 0, 30) }}...</p>
                        </div>
                        <div class="flex flex-align">
                            <div class="text-right m-5">
                                <a href="{{ route('articles.edit', $article->id) }}" class="text-red-500 hover:text-red-700">Modifier</a>
                            </div>
                            <div class="text-right m-5">
                                <a href="{{ route('articles.remove', $article->id) }}" class="text-red-500 hover:text-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">Supprimer</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-3">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
