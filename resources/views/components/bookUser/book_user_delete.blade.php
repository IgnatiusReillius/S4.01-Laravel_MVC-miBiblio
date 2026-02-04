<div class="search-book fixed bottom-20 right-20 z-20" title="Elimina tu reseña">
    <div class="search-book-button active" style="display:block;">
        <form action="{{ route('bookUser.destroy', $bookUser) }}" 
            method="POST"  
            onsubmit="return confirm('¿Seguro que quieres eliminar este libro?')">
                @csrf
                @method('DELETE')

                <button type="submit">
                    <img data-view="search" 
                        class="cursor-pointer toggle-action-book"
                        src="{{ asset('images/icon_delete_book_user.svg') }}" />
                </button>
            </form>
    </div>
</div>
