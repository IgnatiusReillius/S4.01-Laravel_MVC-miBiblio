<div class="add-book fixed bottom-20 right-20 z-50">
    <div class="add-book-view add-book-button active" style="display:block;">
        <img data-view="add-book-button" class="cursor-pointer toggle-add-book"
            src="{{ asset('images/icon_add_book.svg') }}" />
    </div>
</div>
<div class="add-book fixed z-50">
    <div class="add-book-view add-book-bg w-screen h-screen relative inline-flex justify-start items-start overflow-hidden z-50" style="display:none;">
        <div class="w-1/2 h-1/2 px-7 pt-5 top-1/2 left-1/2 absolute bg-gray-200 rounded-md outline outline-8 outline-white inline-flex flex-col justify-start items-start gap-2.5 z-50" style="transform: translate(-50%, -50%);">
            {{-- <div class="absolute -top-5 -right-5 cursor-pointer">
                <img src="{{ asset('images/icon_add_close.svg') }}" class="w-10 h-10" data-view="add-book-bg"/>
            </div> --}}
            <div class="container flex flex-col gap-7 flex-1 min-h-0">
                <div class="container flex flex-row items-center  gap-6">
                    <h2 class="text-neutral-600 align-middle">Buscar libros</h2>
                    <input type="text" id="searchBook" class="form-control" placeholder="Escribe el título del libro..." autocomplete="off">
                </div>
                <!-- Contenedor donde se mostrarán los resultados -->
                <div id="results" class="list-group text-neutral-600 flex flex-col gap-2 flex-1 overflow-y-auto"></div>
            </div>
        </div>
        <div data-view="add-book-bg" class="cursor-pointer toggle-add-book bg-black opacity-50 h-screen w-screen z-25"></div>
    </div>
</div>
