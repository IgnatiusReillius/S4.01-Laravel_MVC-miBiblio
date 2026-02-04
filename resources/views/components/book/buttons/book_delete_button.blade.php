<div class="search-book fixed bottom-20 left-20 z-20" title="Elimina este libro">
    <div class="search-book-button active" style="display:block;">
        <form action="{{ route('book.destroy', $bookUser->book) }}" 
            method="POST"  
            onsubmit="return confirm('¿Seguro que quieres eliminar este libro?')">
                @csrf
                @method('DELETE')

                <button type="submit">
                    <img data-view="search" 
                        class="cursor-pointer"
                        src="{{ asset('images/icon_delete_book.svg') }}" />
                </button>
            </form>
    </div>
</div>
