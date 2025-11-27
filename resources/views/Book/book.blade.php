{{-- @extends('layouts.app') --}}

{{-- @section('title', 'Mi biblioteca') --}}

{{-- @section('content') --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $book->title }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-UI_components.go_back />
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ route('bookUser.edit', $bookUser->id) }}">
                <div>Editar libro</div>
            </a>
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <form action="{{ route('bookUser.destroy', $bookUser) }}" method="POST"  onsubmit="return confirm('¿Seguro que quieres eliminar este libro?')">
                @csrf
                @method('DELETE')

                <button type="submit">
                    Borrar libro
                </button>
            </form>
        </h2>
    </x-slot>

    <x-book.book_cover :bookUser="$bookUser"/>
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
                    <div class="font-bold">Fecha de adición: {{ $bookUser->add_date }}</div>
                    <div class="font-bold">Fecha de lectura: {{ $bookUser->read_date}}</div>
                    <div class="font-bold">Notas: {{ $bookUser->comment }}</div>
                    <div class="font-bold">Estado: {{ ucfirst($bookUser->state?->value) ?? 'Sin asignar'}}</div>
                    <div class="font-bold">Mi puntuación: {{ $bookUser->property }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<body class="h-screen m-0">
