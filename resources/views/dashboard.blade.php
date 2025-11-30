<x-app-layout>
<x-book.book_add/>
    <div class="h-screen w-screen inline-flex justify-start items-start overflow-hidden" >

        {{-- barra lateral --}}
        <div class="w-72 self-stretch p-7 bg-gray-100">

            {{-- tus libros o deseados  --}}
            <div class="flex-col mb-10">
                <x-UI_components.owned-wish_selector :category="$category"/>
            </div>

            {{-- filtros --}}
            <div class="flex-col">
                <x-UI_components.booksFilter :authors="$authors" :publishers="$publishers" :ratings="$ratings" :states="$states" :category="$category" :order="$order"/>
            </div>
        </div>

        {{-- cuerpo principal --}}
        <div class="flex-1 self-stretch  inline-flex flex-col justify-start items-start overflow-hidden">

            {{-- barra superior --}}
            <div class="self-stretch flex flex-row justify-between h-24 pl-7 pr-14 py-7 bg-gray-300">

                {{-- ordenar por --}}
                <x-UI_components.bookOrder :order="$order" :category="$category"/>

                {{-- selector de vista de libros --}}
                <div class="text-neutral-600 ">
                    <x-UI_components.booksViewSelectorBar />
                </div>

                @include('layouts.navigation')

            </div>

            {{-- lista de libros --}}
            <div class="self-stretch flex-1 px-7 pt-5 bg-gray-200 min-h-0 overflow-y-auto">
                <x-book.booksViewDashboard :booksUser="$booksUser"/>
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
                list_view.style.display = "flex";
            }
            else if(li_view == "list-detailed-view") {
                list_detailed_view.style.display = "flex";
            }
            else if(li_view == "grid-small-view") {
                grid_small_view.style.display = "flex"; 
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
                            <div class="flex flex-row">
                                <div class="flex flex-col opacity-50">
                                    <strong>${book.title}</strong> 
                                    <span class="text-sm">${book.author}</span>
                                </div>
                                <div class="flex items-center"> - Ya está en tu biblioteca</div>
                            </div>
                        `;
                    } else {
                        const propertyValue = currentCategory === 'owned' ? 1 : 0;

                        resultsDiv.innerHTML += `
                            <form action="{{ route('bookUser.store') }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="book_id" value="${book.id}">
                                <input type="hidden" name="property" value="${propertyValue}">

                                <button type="submit" class="book-select text-left">
                                    <div class="flex flex-col">
                                        <strong>${book.title}</strong> 
                                        <span class="text-sm">${book.author}</span>
                                    </div>
                                </button>
                            </form>
                        `;
                    }
                });
            });
    });
</script>
