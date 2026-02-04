@props(['bookUser'])
<div class="fixed bottom-20 right-60 z-20" title="Edita tu reseña">
    <a href="{{ route('bookUser.edit', $bookUser) }}">
        <img class="cursor-pointer"
            src="{{ asset('images/icon_update_book_user.svg') }}" />
    </a>
</div>