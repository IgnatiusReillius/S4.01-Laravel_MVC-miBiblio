@props(['books', 'booksUser'])
@if($booksUser->isEmpty())
    <div class="w-full h-full px-7 pt-5">
        <div class="font-bold top-1/2 left-1/2">No tienes libros en tu biblioteca, empieza por añadir algunos aquí</div>
    </div>
@else
    <div>
        {{-- lista --}}
        <div class="view_wrap list-view" style="flex-direction: column; gap: 10px; display: flex">
            @foreach ($booksUser as $bookUser)
                <a href="{{ route('bookUser.show', [$bookUser]) }}">
                    <div>
                        <span class="font-bold">"{{ $bookUser->book->title }}"</span>, 
                        escrito por <span class="font-bold">{{ $bookUser->book->author }}</span>, 
                        ISBN <span class="font-bold">{{ $bookUser->book->isbn }}</span>, 
                        publicado por <span class="font-bold">{{ $bookUser->book->publisher }}</span> el <span class="font-bold">{{ $bookUser->book->publish_date }}</span>, 
                        con <span class="font-bold">{{ $bookUser->book->pages }}</span> páginas.
                    </div>
                </a>
            @endforeach
        </div>
        {{-- detallada --}}
        <div class="view_wrap list-detailed-view flex-col gap-2" style="display: none;">
            @foreach ($booksUser as $bookUser)
                <a href="{{ route('bookUser.show', [$bookUser]) }}">
                    <div class="flex flex-row">
                        <x-book.book_cover :bookUser="$bookUser" size="small"/>
                        <div class="ml-3">
                            <span class="font-bold">Título:</span> {{ $bookUser->book->title }}    
                            <span class="font-bold ml-3">Autor:</span> {{ $bookUser->book->author }}     
                            <span class="font-bold ml-3">Editorial:</span> {{ $bookUser->book->publisher }}      
                            <span class="font-bold ml-3">Fecha de publicación:</span> {{ $bookUser->book->publish_date }} 
                            <span class="font-bold ml-3">Páginas:</span> {{ $bookUser->book->pages }} 
                            <span class="font-bold ml-3">ISBN-10:</span> {{ $bookUser->book->isbn }} 
                            <span class="font-bold ml-3">Sinopsis:</span> {{ $bookUser->book->summary }} 
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        {{-- pequeña --}}
        <div class="view_wrap grid-small-view gap-1" style="display: none;">
            @foreach ($booksUser as $bookUser)
                <a href="{{ route('bookUser.show', [$bookUser]) }}">
                    <x-book.book_cover :bookUser="$bookUser" size="medium"/>
                </a>
            @endforeach
        </div>
        {{-- grande --}}
        <div class="view_wrap grid-big-view gap-2 " style="display: none;">
            @foreach ($booksUser as $bookUser)
                <a href="{{ route('bookUser.show', [$bookUser]) }}">
                    <x-book.book_cover :bookUser="$bookUser"  size="large"/>
                </a>
            @endforeach
        </div>
    </div>
@endif