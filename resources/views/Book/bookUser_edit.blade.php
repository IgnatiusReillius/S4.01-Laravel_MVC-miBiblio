{{-- @extends('layouts.app') --}}

{{-- @section('title', 'Mi biblioteca') --}}

{{-- @section('content') --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editando {{ $bookUser->book->title }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-UI_components.go_back />
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="font-bold">Titulo: {{ $book->title }}</div>
                    <div class="font-bold">Autor: {{ $book->author }}</div>
                    <div class="font-bold">Editorial: {{ $book->publisher }}</div>
                    <div class="font-bold">Fecha de publicación: {{ $book->publish_date }}</div>
                    <div class="font-bold">Páginas: {{ $book->pages }}</div>
                    <div class="font-bold">ISBN: {{ $book->isbn }}</div>
                    <div class="font-bold">Sinopsis: {{ $book->summary }}</div>
                    {{-- <div class="font-bold">Notas: {{ $bookUser->comment }}</div> --}}
                    <form method="POST" action="{{ route('bookUser.update', $bookUser) }}">
                        @csrf
                        @method('PUT')

                        {{-- Fecha de adición --}}
                        <div class="font-bold">Fecha de adición: {{ $bookUser->add_date }}</div>

                        {{-- Fecha de lectura --}}
                        <div class="font-bold">Fecha de lectura: {{ $bookUser->read_date}}</div>
                        
                        {{-- Notas --}}
                        <div>
                            <label for="comment">Notas:</label>
                            <input type="text" name="comment" value="{{ $bookUser->comment }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-gray-900 "> 
                        </div>

                        {{-- Estado --}}
                        <div>
                            <label for="state">Estado:</label>
                            <select name="state" class="text-gray-900">
                                @foreach(\App\Enums\BookUserState::cases() as $state)
                                    <option value="{{ $state->value }}" @selected($bookUser->state === $state)>
                                        {{ ucfirst($state->value) }}
                                    </option>
                                @endforeach
                            </select> 
                        </div>

                        {{-- Puntuación --}}
                        <div class="font-bold">Mi puntuación: {{ $bookUser->rating }}</div>

                        {{-- Botón de guardado --}}
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"> 
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<body class="h-screen m-0">
