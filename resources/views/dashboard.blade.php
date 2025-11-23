{{-- @props(['bookUser']) --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tus libros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if($booksUser->empty())
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="font-bold">No tienes libros en tu biblioteca, empieza por añadir algunos aquí</div>
                    </div>
                </div>
            </div>    
        @else
            @foreach ($booksUser as $bookUser)
                <a href="{{ route('bookUser.show', $bookUser) }}">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                {{-- <div>registro en BookUser = {{$bookUser->id}}</div>
                                <div>book ID = {{$bookUser->book_id}}</div> --}}
                                <div class="font-bold">{{ $bookUser->book->title }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('bookUser.create') }}"> Añadir libro
                </a>
            </div>
        </div>
    </div>

    {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('bookUser.delete', $booksUser) }}"> Borrar libro
                </a>
            </div>
        </div>
    </div> --}}
</x-app-layout>
