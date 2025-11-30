@props(['authors', 'publishers', 'ratings', 'states', 'category', 'order'])

<form method="GET" action="{{ route('dashboard') }}" class="flex flex-col gap-1 text-neutral-600">
                
    <input type="hidden" name="category" value="{{ $category }}">
    <input type="hidden" name="order" value="{{ $order }}">

    <label for="author" class="font-bold">Autor:</label>
    <select name="author" id="author" onchange="this.form.submit()" class="text-gray-900 mb-6">
        <option value="">Todos</option>
        @foreach($authors as $author)
            <option value="{{ $author }}" @selected(request('author') == $author)>
                {{ $author }}
            </option>
        @endforeach
    </select>

    <label for="publisher" class="font-bold">Editorial:</label>
    <select name="publisher" id="publisher" onchange="this.form.submit()" class="text-gray-900 mb-6">
        <option value="">Todas</option>
        @foreach($publishers as $publisher)
            <option value="{{ $publisher }}" @selected(request('publisher') == $publisher)>
                {{ $publisher }}
            </option>
        @endforeach
    </select>

    @if ($category == 'owned')
        <label for="rating" class="font-bold">Puntuación:</label>
        <select name="rating" id="rating" onchange="this.form.submit()" class="text-gray-900 mb-6">
            <option value="">Todas</option>
            @foreach($ratings as $rating)
                <option value="{{ $rating }}" @selected(request('rating') == $rating)>
                    {{ str_repeat('★', $rating) }}
                </option>
            @endforeach
        </select>

        <label for="state" class="font-bold">Estado:</label>
        <select name="state" id="state" onchange="this.form.submit()" class="text-gray-900 mb-6">
            <option value="">Todos</option>
            @foreach($states as $state)
                <option value="{{ $state }}" @selected(request('state') == $state)>
                    {{ $state }}
                </option>
            @endforeach
        </select>
    @endif
</form>