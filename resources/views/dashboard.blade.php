<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Affichage message flash de type "success" -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Affichage message flash de type "error" -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled text-start m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="mt-3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Liste des articles de l'utilisateur connecté  --> 
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Mes articles') }}
                    </h2>
                    @foreach($articles as $article)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                            <div class="p-6 text-gray-900">
                                <h2 class="text-2xl font-bold">{{ $article->title }}</h2>
                                <p class="text-gray-700">{{ substr($article->content, 0, 30) }}...</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
