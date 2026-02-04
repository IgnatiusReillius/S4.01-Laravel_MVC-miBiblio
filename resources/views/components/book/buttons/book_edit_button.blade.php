@props(['bookUser'])
<div class="fixed bottom-20 left-20 z-20" title="Edita este libro">
    <a href="{{ route('book.edit', $bookUser) }}">
        <img class="cursor-pointer"
            src="{{ asset('images/icon_update_book.svg') }}" />
    </a>
</div>