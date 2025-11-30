<x-app-layout>
    <div class="h-screen w-screen inline-flex justify-start items-start overflow-hidden" >

        {{-- cuerpo principal --}}
        <div class="flex-1 self-stretch bg-stone-400 inline-flex flex-col justify-start items-start overflow-hidden">

            {{-- barra superior --}}
            <div class="self-stretch flex flex-row justify-between h-24 pl-7 pr-14 py-7 bg-gray-300">

                {{-- volver atrás --}}
                <x-UI_components.go_back/>

                {{-- editar o borrar libro --}}
                <div class="text-neutral-600 ">
                    <x-book.book_delete_edit_icons :bookUser="$bookUser"/>
                </div>
            </div>

            {{-- lista de libros --}}
            <div class="self-stretch flex-1 px-7 pt-5 bg-gray-200">
                <div class="flex flex-row">
                    <x-book.book_cover :bookUser="$bookUser" size="giant"/>
                    <div class="ml-3 ">
                        <div class="mb-2"><span class="font-bold">Título:</span> {{ $bookUser->book->title }}</div>
                        <div class="mb-2"><span class="font-bold">Autor:</span> {{ $bookUser->book->author }}</div>
                        <div class="mb-2"><span class="font-bold">Editorial:</span> {{ $bookUser->book->publisher }}</div>
                        <div class="mb-2"><span class="font-bold">Fecha de publicación:</span> {{ $bookUser->book->publish_date }}</div>
                        <div class="mb-2"><span class="font-bold">Páginas:</span> {{ $bookUser->book->pages }}</div>
                        <div class="mb-2"><span class="font-bold">ISBN-10:</span> {{ $bookUser->book->isbn }}</div>
                        <div class="mb-2"><span class="font-bold">Sinopsis:</span> {{ $bookUser->book->summary }}</div>
                        <form method="POST" action="{{ route('bookUser.update', $bookUser) }}">
                            @csrf
                            @method('PUT')

                            {{-- Fecha de adición --}}
                            <div>
                                <label for="add_date" class="font-bold">Fecha de adición:</label>
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
                                <label for="read_date" class="font-bold">Fecha de lectura:</label>
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
                                <label for="comment" class="font-bold">Notas:</label>
                                <input type="text" name="comment" value="{{ $bookUser->comment }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-gray-900 "> 
                            </div>

                            {{-- Condición --}}
                            <div>
                                <label for="state" class="font-bold">Condición:</label>
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
                                <label for="property" class="font-bold">Disponibilidad:</label>
                                <select name="property" id="property" class="text-gray-900">
                                    <option value="1" @selected(old('property', (int)$bookUser->property) === 1)>
                                        Lo tengo
                                    </option>
                                    <option value="0" @selected(old('property', (int)$bookUser->property) === 0)>
                                        Lo deseo
                                    </option>
                                </select>
                            </div>

                            {{-- Puntuación --}}
                            <div class="mt-4">
                                <label class="font-bold">Mi puntuación</label>
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
    </div>
</x-app-layout>

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