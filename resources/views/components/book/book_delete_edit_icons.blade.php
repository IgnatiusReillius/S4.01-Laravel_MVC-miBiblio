@props(['bookUser'])
<div class="links flex flex-row gap-2">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ route('bookUser.edit', $bookUser->id) }}">
                <img data-view="list-view" class="active" src="{{ asset('images/icon_edit.svg') }}" />
            </a>
        </h2>
    <form action="{{ route('bookUser.destroy', $bookUser) }}" method="POST"  onsubmit="return confirm('¿Seguro que quieres eliminar este libro?')">
                @csrf
                @method('DELETE')

                <button type="submit">
                    <img data-view="list-detailed-view" class="" src="{{ asset('images/icon_delete.svg') }}" />
                </button>
            </form>
</div>