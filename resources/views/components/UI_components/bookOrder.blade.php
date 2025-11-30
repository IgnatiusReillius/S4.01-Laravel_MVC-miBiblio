@props(['order', 'category'])
<form method="GET" action="{{ route('dashboard') }}" class="mb-4">
    <input type="hidden" name="category" value="{{ $category }}">

    <label class="font-semibold text-sm text-neutral-600 mr-2">Ordenar por:</label>
    <select name="order" id="order" onchange="this.form.submit()" class="text-gray-900">
        <option value="title_asc" @selected($order == 'title_asc')>Título A-Z</option>
        <option value="title_desc" @selected($order == 'title_desc')>Título Z-A</option>

        <option value="author_asc" @selected($order == 'author_asc')>Autor A-Z</option>
        <option value="author_desc" @selected($order == 'author_desc')>Autor Z-A</option>

        <option value="pages_asc" @selected($order == 'pages_asc')>Páginas ↑</option>
        <option value="pages_desc" @selected($order == 'pages_desc')>Páginas ↓</option>

        <option value="date_asc" @selected($order == 'date_asc')>Fecha ↑</option>
        <option value="date_desc" @selected($order == 'date_desc')>Fecha ↓</option>
    </select>
 </form>