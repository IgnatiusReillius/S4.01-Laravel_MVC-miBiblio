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
                        <form method="POST" action="{{ route('book.update', [$book]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="title" class="font-bold">Título:</label>
                                <input 
                                    type="text" 
                                    name="title" 
                                    id="title"
                                    class="text-gray-900"
                                    value="{{ $book->title }}" 
                                >
                            </div>
                            <div>
                                <label for="author" class="font-bold">Autor:</label>
                                <input 
                                    type="text" 
                                    name="author" 
                                    id="author"
                                    class="text-gray-900"
                                    value="{{ $book->author }}" 
                                >
                            </div>
                            <div>
                                <label for="publisher" class="font-bold">Editorial:</label>
                                <input 
                                    type="text" 
                                    name="publisher" 
                                    id="publisher"
                                    class="text-gray-900"
                                    value="{{ $book->publisher }}" 
                                >
                            </div>
                            <div>
                                <label for="publish_date" class="font-bold">Fecha de publicación:</label>
                                <input 
                                    type="date" 
                                    name="publish_date" 
                                    id="publish_date"
                                    class="text-gray-900"
                                    value="{{ $book->publish_date }}" 
                                >
                            </div>
                            <div>
                                <label for="pages" class="font-bold">Páginas:</label>
                                <input 
                                    type="number" 
                                    name="pages" 
                                    id="pages"
                                    class="text-gray-900"
                                    value="{{ $book->pages }}" 
                                >
                            </div>
                            <div>
                                <label for="isbn" class="font-bold">ISBN:</label>
                                <input 
                                    type="text" 
                                    name="isbn" 
                                    id="isbn"
                                    class="text-gray-900"
                                    value="{{ $book->isbn }}" 
                                >
                            </div>
                            <div>
                                <label for="summary" class="font-bold">Sinopsis:</label>
                                <input 
                                    type="text" 
                                    name="summary" 
                                    id="summary"
                                    class="text-gray-900"
                                    value="{{ $book->summary }}" 
                                >
                            </div>
                            <div>
                                <label for="cover_path" class="font-bold">Portada:</label>
                                <input 
                                    type="file" 
                                    name="cover_path" 
                                    id="cover_path"
                                    class="text-gray-900"
                                    value="{{ $book->cover_path }}" 
                                >
                            </div>

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