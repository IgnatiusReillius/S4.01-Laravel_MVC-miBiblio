{{-- @extends('layouts.app') --}}

{{-- @section('title', 'Mi biblioteca') --}}

{{-- @section('content') --}}
<body class="h-screen m-0">
    <x-UI_components.go_back />

    <!-- Panel de contenido -->
    <main class="bg-neutral-300 grid grid-cols-[300px_100%] grid-rows-[100px_1fr] h-screen">
        {{-- <aside class="row-span-2 bg-neutral-200 flex-col justify-between p-[30px]">
            <x-book_cover type="" :book="$book"/>
        </aside> --}}
        <div class="p-3 space-y-2">
            <div class="font-bold">Titulo: {{ $book->title }}</div>
            <div class="font-bold">Autor: {{ $book->author }}</div>
            <div class="font-bold">Editorial: {{ $book->publisher }}</div>
            <div class="font-bold">Fecha de publicación: {{ $book->publish_date }}</div>
            <div class="font-bold">Páginas: {{ $book->pages }}</div>
            <div class="font-bold">ISBN: {{ $book->isbn }}</div>
            <div class="font-bold">Sinopsis: {{ $book->summary }}</div>
            <div class="font-bold">Fecha de adición: </div>
            <div class="font-bold">Fecha de lectura: </div>
            <div class="font-bold">Notas: </div>
            <div class="font-bold">Estado: </div>
            <div class="font-bold">Mi puntuación: </div>
        </div>
    </main>

</body>
{{-- @endsection --}}