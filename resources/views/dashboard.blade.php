<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tus libros') }}
        </h2>
    </x-slot>

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

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('bookUser.create') }}"> Añadir libro
                </a>
            </div>
        </div>
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
                        resultsDiv.innerHTML += `
                            <form action="{{ route('bookUser.store') }}" method="POST" style="margin-bottom:10px;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="book_id" value="${book.id}">

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
