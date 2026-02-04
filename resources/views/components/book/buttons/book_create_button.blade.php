<div class="create-book fixed bottom-20 right-60 z-20" title="Crea un nuevo libro">
    <div class="create-book-button active" style="display:block;">
        <img data-view="create" class="cursor-pointer toggle-action-book"
            src="{{ asset('images/icon_create_book.svg') }}" />
    </div>
</div>
<div class="create-book fixed z-20">
    <div class="create-book-view create-book-bg w-screen h-screen relative inline-flex justify-start items-start overflow-hidden z-50" style="display:none;">
        <div class="w-1/2 h-1/2 px-7 pt-5 top-1/2 left-1/2 absolute bg-gray-200 rounded-md outline outline-8 outline-white inline-flex flex-col justify-start items-start gap-2.5 z-50" style="transform: translate(-50%, -50%);">
            <div class="container flex flex-col gap-7 flex-1 min-h-0">
                <div class="container flex flex-col items-start  gap-6">
                    <h2 class="text-neutral-600 align-center">Añade un nuevo libro a la base de datos:</h2>
                    <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div>
                                <label for="title" class="font-bold">Título:</label>
                                <input 
                                    type="text" 
                                    name="title" 
                                    id="title"
                                    class="text-gray-900"
                                >
                            </div>
                            <div>
                                <label for="author" class="font-bold">Autor:</label>
                                <input 
                                    type="text" 
                                    name="author" 
                                    id="author"
                                    class="text-gray-900"
                                >
                            </div>
                            <div>
                                <label for="isbn" class="font-bold">ISBN:</label>
                                <input 
                                    type="text" 
                                    name="isbn" 
                                    id="isbn"
                                    class="text-gray-900"
                                >
                            </div>
                            <div>
                                <label for="publisher" class="font-bold">Editorial:</label>
                                <input 
                                    type="text" 
                                    name="publisher" 
                                    id="publisher"
                                    class="text-gray-900"
                                >
                            </div>
                            <div>
                                <label for="publish_date" class="font-bold">Fecha de publicación:</label>
                                <input 
                                    type="date" 
                                    name="publish_date" 
                                    id="publish_date"
                                    class="text-gray-900"
                                    max="{{ now()->format('Y-m-d') }}"
                                >
                            </div>
                            <div>
                                <label for="pages" class="font-bold">Páginas:</label>
                                <input 
                                    type="number" 
                                    name="pages" 
                                    id="pages"
                                    class="text-gray-900"
                                >
                            </div>
                            <div>
                                <label for="summary" class="font-bold">Resumen:</label>
                                <input 
                                    type="text" 
                                    name="summary" 
                                    id="summary"
                                    class="text-gray-900"
                                >
                            </div>
                            <div>
                                <label for="cover_path" class="font-bold">Portada:</label>
                                <input 
                                    type="file" 
                                    name="cover_path" 
                                    id="cover_path"
                                    class="text-gray-900"
                                >
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"> 
                                Crear
                            </button>
                    </form>
                </div>
            </div>
        </div>
        <div data-view="close" class="cursor-pointer toggle-action-book bg-black opacity-50 h-screen w-screen z-25"></div>
    </div>
</div>
