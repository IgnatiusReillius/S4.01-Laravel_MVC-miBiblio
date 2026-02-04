<x-UI_components.message/>
<x-bookUser.book_user_edit :bookUser="$bookUser"/>
<x-bookUser.book_user_delete :bookUser="$bookUser"/>
<x-book.buttons.book_delete_button :bookUser="$bookUser"/>
<x-book.buttons.book_edit_button :bookUser="$bookUser"/>
<x-app-layout>
    <div class="h-screen w-screen inline-flex justify-start items-start overflow-hidden" >

        <div class="flex-1 self-stretch bg-stone-400 inline-flex flex-col justify-start items-start overflow-hidden">

            <div class="self-stretch flex flex-row justify-between h-24 pl-7 pr-14 py-7 bg-gray-300">

                <x-UI_components.go_back/>
            </div>

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
                        <div class="mb-2"><span class="font-bold">Fecha de adición:</span> {{ $bookUser->add_date ? $bookUser->add_date->format('d/m/Y') : 'Sin leer' }}</div>
                        <div class="mb-2"><span class="font-bold">Fecha de lectura:</span> {{ $bookUser->read_date ? $bookUser->read_date->format('d/m/Y') : 'Sin leer' }}</div>
                        <div class="mb-2"><span class="font-bold">Notas:</span> {{ $bookUser->comment }}</div>
                        <div class="mb-2"><span class="font-bold">Condición:</span> {{ ucfirst($bookUser->state?->value) ?? 'Sin asignar'}}</div>
                        <div class="mb-2"><span class="font-bold">Disponibilidad:</span> {{ $bookUser->property ? 'Lo tengo' : 'Lo deseo'}}</div>
                        <div class="mb-2"><span class="font-bold">Puntuación:</span>  
                            <div class="flex items-center space-x-1 star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <img src="{{ $i <= $bookUser->rating 
                                        ? asset('images/icon_star_full.svg') 
                                        : asset('images/icon_star_empty.svg') }}"
                                        class="w-4 h-4">
                                @endfor</div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>