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
                        <div>
                            <label for="add_date">Fecha de adición:</label>
                            <input 
                                type="date" 
                                name="add_date" 
                                id="add_date"
                                class="text-gray-900"
                                max="{{ now()->format('Y-m-d') }}"
                                value="{{ old('add_date', optional($bookUser->add_date)->format('Y-m-d')) }}"
                            >
                        </div>

                        {{-- Fecha de lectura --}}
                        <div>
                            <label for="read_date">Fecha de lectura:</label>
                            <input 
                                type="date" 
                                name="read_date" 
                                id="read_date"
                                class="text-gray-900"
                                max="{{ now()->format('Y-m-d') }}"
                                value="{{ old('read_date', optional($bookUser->read_date)->format('Y-m-d')) }}"
                            >
                        </div>
                        
                        {{-- Notas --}}
                        <div>
                            <label for="comment">Notas:</label>
                            <input type="text" name="comment" value="{{ $bookUser->comment }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-gray-900 "> 
                        </div>

                        {{-- Condición --}}
                        <div>
                            <label for="state">Condición:</label>
                            <select name="state" class="text-gray-900">
                                @foreach(\App\Enums\BookUserState::cases() as $state)
                                    <option value="{{ $state->value }}" @selected($bookUser->state === $state)>
                                        {{ ucfirst($state->value) }}
                                    </option>
                                @endforeach
                            </select> 
                        </div>

                        
                        {{-- Disponibilidad --}}
                        <div>
                            <label for="property">Disponibilidad:</label>
                            <select name="property" id="property" class="text-gray-900">
                                <option value="1" @selected(old('property', (int)$bookUser->property) === 1)>
                                    Lo tengo
                                </option>
                                <option value="0" @selected(old('property', (int)$bookUser->property) === 0)>
                                    Lo deseo
                                </option>
                            </select>
                        </div>

                        {{-- Puntuación
                        <div>
                            <label for="rating">Mi puntuación:</label>
                            <select name="rating" id="rating" class="text-gray-900">
                                <option value="">Sin puntuación</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" @selected(old('rating', $bookUser->rating) == $i)>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div> --}}

                        {{-- Puntuación con estrellas personalizadas --}}
                        {{-- Puntuación con estrellas personalizadas --}}
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                Mi puntuación
                            </label>

                            <div class="flex items-center space-x-1 star-rating" data-current="{{ old('rating', $bookUser->rating ?? 0) }}">
                                <input type="hidden" name="rating" id="rating" value="{{ old('rating', $bookUser->rating ?? 0) }}">

                                @for ($i = 1; $i <= 5; $i++)
                                    <img
                                        src="{{ asset('images/icon_star_empty.svg') }}"
                                        data-value="{{ $i }}"
                                        class="star w-8 h-8 cursor-pointer transition-transform duration-200 hover:scale-110"
                                        alt="Estrella {{ $i }}"
                                    >
                                @endfor
                            </div>
                        </div>




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

 <script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.star-rating');
    const stars = container.querySelectorAll('.star');
    const input = document.getElementById('rating');

    const starFull = "{{ asset('images/icon_star_full.svg') }}";
    const starEmpty = "{{ asset('images/icon_star_empty.svg') }}";

    function paintStars(rating) {
        stars.forEach(star => {
            const value = star.dataset.value;

            if (value <= rating) {
                star.src = starFull;
            } else {
                star.src = starEmpty;
            }
        });
    }

    paintStars(container.dataset.current);

    stars.forEach(star => {

        star.addEventListener('click', function () {
            const value = this.dataset.value;
            input.value = value;
            paintStars(value);
        });

        star.addEventListener('mouseenter', function () {
            paintStars(this.dataset.value);
        });

        star.addEventListener('mouseleave', function () {
            paintStars(input.value);
        });

    });
});
</script>