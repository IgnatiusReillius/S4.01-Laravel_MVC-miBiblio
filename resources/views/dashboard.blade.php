<x-UI_components.message/>
<x-book.buttons.book_search_button/>
<x-book.buttons.book_create_button/>
<x-app-layout>
    <div class="h-screen w-screen inline-flex justify-start items-start overflow-hidden" >

        <div class="w-72 self-stretch p-7 bg-gray-100">

            <div class="flex-col mb-10">
                <x-UI_components.owned-wish_selector :category="$category"/>
            </div>

            <div class="flex-col">
                <x-UI_components.booksFilter :authors="$authors" :publishers="$publishers" :ratings="$ratings" :states="$states" :category="$category" :order="$order"/>
            </div>
        </div>

        <div class="flex-1 self-stretch  inline-flex flex-col justify-start items-start overflow-hidden">

            <div class="self-stretch flex flex-row justify-between h-24 pl-7 pr-14 py-7 bg-gray-300">

                <x-UI_components.bookOrder :order="$order" :category="$category"/>

                <div class="text-neutral-600 ">
                    <x-UI_components.booksViewSelectorBar />
                </div>

                @include('layouts.navigation')

            </div>

            <div class="self-stretch flex-1 px-7 pt-5 bg-gray-200 min-h-0 overflow-y-auto">
                <x-book.booksViewDashboard :books="$books" :booksUser="$booksUser" />
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
document.addEventListener("DOMContentLoaded", function () {

    const toggleButtons = document.querySelectorAll(".toggle-action-book");
    const searchViews = document.querySelectorAll(".search-book-view");
    const createViews = document.querySelectorAll(".create-book-view");

    function hideAll() {
        searchViews.forEach(v => v.style.display = "none");
        createViews.forEach(v => v.style.display = "none");
    }

    toggleButtons.forEach(button => {
        button.addEventListener("click", function () {
            const view = this.dataset.view;

            hideAll();

            if (view === "search") {
                searchViews.forEach(v => v.style.display = "block");
            }

            if (view === "create") {
                createViews.forEach(v => v.style.display = "block");
            }

            if (view === "close") {
                hideAll();
            }
        });
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