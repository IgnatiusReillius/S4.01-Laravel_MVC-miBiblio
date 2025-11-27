@props(['booksUser'])
@if(@empty($booksUser))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="font-bold">No tienes libros en tu biblioteca, empieza por añadir algunos aquí</div>
            </div>
        </div>
    </div>
@else
    <div>
        <div class="view_wrap list-view" style="display: block;">
            <p>Lista</p>
            @foreach ($booksUser as $bookUser)
                <a href="{{ route('bookUser.show', $bookUser) }}">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <div class="font-bold">{{ $bookUser->book->title }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="view_wrap list-detailed-view" style="display: none;">
            <p>Detallada</p>
            @foreach ($booksUser as $bookUser)
                <a href="{{ route('bookUser.show', $bookUser) }}">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                {{-- <x-book.book_cover :bookUser="$bookUser" /> --}}
                                <div class="font-bold">{{ $bookUser->book->title }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="view_wrap grid-small-view" style="display: none;">
            <p>Pequeña</p>
            @foreach ($booksUser as $bookUser)
                <a href="{{ route('bookUser.show', $bookUser) }}">
                    <x-book.book_cover :bookUser="$bookUser" />
                </a>
            @endforeach
        </div>
        <div class="view_wrap gridp-big-view" style="display: none;">
            @foreach ($booksUser as $bookUser)
                <div class="w-5 h-5 m-1 border-2 rounded-sm bg-amber-200">F</div>
                <a href="{{ route('bookUser.show', $bookUser) }}">
                    <div>
                        <x-book.book_cover :bookUser="$bookUser" class="size-5" />
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif