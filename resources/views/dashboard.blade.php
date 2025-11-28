<x-app-layout>
    <x-slot name="header">
        @if ( $category == 'owned')
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-400 leading-tight">
                Tus libros
            </h2>
            <form method="GET" action="{{ route('dashboard') }}" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <input type="hidden" name="category" value="wishlist">
                <button type="submit" class="book-select">
                    Tus deseados
                </button>
            </form>
        @else
            <form method="GET" action="{{ route('dashboard') }}" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <input type="hidden" name="category" value="owned">
                <button type="submit" class="book-select">
                    Tus libros
                </button>
            </form>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-400 leading-tight">
                Tus deseados
            </h2>
        @endif
    </x-slot>

    <form method="GET" action="{{ route('dashboard') }}" class="mb-4 flex gap-4 items-center">

        <input type="hidden" name="category" value="{{ $category }}">
        <input type="hidden" name="order" value="{{ $order }}">

        <label class="text-white mr-2">Ordenar por:</label>
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

        <label for="author" class="text-white">Autor:</label>
        <select name="author" id="author" onchange="this.form.submit()" class="text-gray-900">
            <option value="">Todos</option>
            @foreach($authors as $author)
                <option value="{{ $author }}" @selected(request('author') == $author)>
                    {{ $author }}
                </option>
            @endforeach
        </select>

        <label for="publisher" class="text-white">Editorial:</label>
        <select name="publisher" id="publisher" onchange="this.form.submit()" class="text-gray-900">
            <option value="">Todas</option>
            @foreach($publishers as $publisher)
                <option value="{{ $publisher }}" @selected(request('publisher') == $publisher)>
                    {{ $publisher }}
                </option>
            @endforeach
        </select>

        @if ( $category == 'owned')
            <label for="rating" class="text-white">Puntuación:</label>
            <select name="rating" id="rating" onchange="this.form.submit()" class="text-gray-900">
                <option value="">Todas</option>
                @foreach($ratings as $rating)
                    <option value="{{ $rating }}" @selected(request('rating') == $rating)>
                        {{ str_repeat('★', $rating) }}
                    </option>
                @endforeach
            </select>

            <label for="state" class="text-white">Estado:</label>
            <select name="state" id="state" onchange="this.form.submit()" class="text-gray-900">
                <option value="">Todos</option>
                @foreach($states as $state)
                    <option value="{{ $state }}" @selected(request('state') == $state)>
                        {{ $state }}
                    </option>
                @endforeach
            </select>
        @endif

    </form>

    <div class="add-book fixed bottom-20 left-6 z-50">
        <div class="add-book-view add-book-button active" style="display:block;">
            <img 
                data-view="add-book-button"
                class="cursor-pointer toggle-add-book"
                src="{{ asset('images/icon_add_book.svg') }}" />
        </div>
        <div class="add-book-view add-book-bg" style="display:none;">
            <img 
                data-view="add-book-bg"
                class="cursor-pointer toggle-add-book"
                src="{{ asset('images/icon_add_close.svg') }}" />
            <x-book.books_search/>
        </div>
    </div>

    <div class="text-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <x-UI_components.booksViewSelectorBar />
    </div>

    <div class="py-12 dark:text-gray-100">
        <x-book.booksViewDashboard :booksUser="$booksUser"/>
    </div>


</x-app-layout>

<script>
    var li_links = document.querySelectorAll(".links img");
    var view_wraps = document.querySelectorAll(".view_wrap");
    var list_view = document.querySelector(".list-view");
    var list_detailed_view = document.querySelector(".list-detailed-view");
    var grid_small_view = document.querySelector(".grid-small-view");
    var grid_big_view = document.querySelector(".grid-big-view");
    
    li_links.forEach(function(link) {
        link.addEventListener("click", function() {
            li_links.forEach(function(link) {
                link.classList.remove("active");
            })
    
            link.classList.add("active");
            var li_view = link.getAttribute("data-view");
            
            view_wraps.forEach(function(view) {
                view.style.display = "none";
            })
    
            if(li_view == "list-view") {
                list_view.style.display = "block";
            }
            else if(li_view == "list-detailed-view") {
                list_detailed_view.style.display = "block";
            }
            else if(li_view == "grid-small-view") {
                grid_small_view.style.display = "block"; 
            }
            else {
                grid_big_view.style.display = "flex";
            }
        })
    })
</script>

<script>
    var toggleButtons = document.querySelectorAll(".toggle-add-book");
    var add_book_views = document.querySelectorAll(".add-book-view");
    var add_book_button = document.querySelector(".add-book-button");
    var add_book_bg = document.querySelector(".add-book-bg");

    toggleButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            var view = button.getAttribute("data-view");

            add_book_views.forEach(function(view) {
                view.style.display = "none";
            });

            if(view === "add-book-button") {
                add_book_bg.style.display = "block";
            } else {
                add_book_button.style.display = "block";
            }
        });
    });
</script>

<script>
    const currentCategory = "{{ request('category', 'wishlist') }}";

    document.getElementById('searchBook').addEventListener('keyup', function () {
        let query = this.value;

        if (query.length < 3) {
            document.getElementById('results').innerHTML = 'Introduce más de 2 letras para empezar a buscar.';
            return;
        }

        fetch("{{ route('books.search') }}?fetchQuery=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                let resultsDiv = document.getElementById('results');
                resultsDiv.innerHTML = '';

                if (data.books.length === 0) {
                    resultsDiv.innerHTML = '<div>No se encontraron resultados</div>';
                    return;
                }

                data.books.forEach(book => {

                    const alreadyOwned = data.userBooks.includes(book.id);

                    if (alreadyOwned) {
                        resultsDiv.innerHTML += `
                            <div class="text-gray-500">
                                <strong>${book.title}</strong> - Ya lo tienes
                            </div>
                        `;
                    } else {
                        const propertyValue = currentCategory === 'owned' ? 1 : 0;

                        resultsDiv.innerHTML += `
                            <form action="{{ route('bookUser.store') }}" method="POST" style="margin-bottom:10px;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="book_id" value="${book.id}">
                                <input type="hidden" name="property" value="${propertyValue}">

                                <button type="submit" class="book-select">
                                    ${book.title}
                                </button>
                            </form>
                        `;
                    }
                });
            });
    });
</script>
